function xhr(method, link, arg) {
    return new Promise((resolve, reject) => {
        const req = new XMLHttpRequest();

        req.open(method, link, true);

        req.responseType = 'json';
        req.withCredentials = method.toUpperCase() !== 'GET';
        req.setRequestHeader('Content-type', 'application/json');
        req.setRequestHeader('Access-Control-Allow-Origin', window.self.origin);

        req.onload = () => {
            if (req.readyState === 4) {
                resolve(req.response);
            }
        };
        req.onerror = () => reject(req.statusText);

        req.send(arg);
    });
}

async function populateTable() {
    const table = document.querySelector('table');
    const tableHead = table.tHead;
    const tableBody = table.tBodies[0];
    const res = await xhr('GET', '/res/php/get_all.php');
    if (res) {
        const headRow = tableHead.insertRow(0);
        const domCell = headRow.insertCell(0);
        domCell.innerText = 'Domain';
        const channelsElem = {};
        res.channel.forEach((c, i) => {
            const newHCell = headRow.insertCell(i + 1);
            newHCell.innerText = c.Name;
            channelsElem[c.Id] = i + 1;
        });
        const doms = {};
        res.domain.forEach((d, i) => {
            const newRow = tableBody.insertRow(-1);
            const newCell = newRow.insertCell(0);
            newCell.innerText = d.DomainName.replaceAll('\n', '');
            doms[d.Id] = i
        });
        res.access.forEach((a) => {
            const newCell = tableBody.rows[doms[a.DomainId]].insertCell(channelsElem[a.channelId]);
            newCell.innerText = 'X';
        });
        
    }
}

function init() {
    populateTable();
}

init();
