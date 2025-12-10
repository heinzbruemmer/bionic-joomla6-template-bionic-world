/**
 * Bionic World Template - Responsive Tables
 * Fügt automatisch data-label Attribute zu Tabellenzellen hinzu
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Finde alle Tabellen im Dokument (auch in Wrapper-Divs)
    const tables = document.querySelectorAll('table');
    
    tables.forEach(table => {
        // Überspringe Tabellen, die bereits verarbeitet wurden
        if (table.classList.contains('responsive-processed')) {
            return;
        }
        
        // Finde thead und tbody
        const thead = table.querySelector('thead');
        const tbody = table.querySelector('tbody');
        
        // Wenn kein thead vorhanden, versuche erste tr als Header
        let headers = [];
        if (thead) {
            headers = Array.from(thead.querySelectorAll('th')).map(th => th.textContent.trim());
        } else {
            const firstRow = table.querySelector('tr');
            if (firstRow) {
                const firstRowCells = firstRow.querySelectorAll('th');
                if (firstRowCells.length > 0) {
                    headers = Array.from(firstRowCells).map(th => th.textContent.trim());
                }
            }
        }
        
        // Wenn keine Header gefunden, überspringe diese Tabelle
        if (headers.length === 0) {
            console.log('Keine Header gefunden für Tabelle, überspringe...');
            return;
        }
        
        // Finde alle Datenzeilen
        const rows = tbody ? tbody.querySelectorAll('tr') : table.querySelectorAll('tr:not(:first-child)');
        
        // Füge data-label zu jeder Zelle hinzu
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            cells.forEach((cell, index) => {
                // Nur hinzufügen, wenn noch kein data-label vorhanden
                if (!cell.hasAttribute('data-label') && headers[index]) {
                    cell.setAttribute('data-label', headers[index]);
                }
            });
        });
        
        // Markiere Tabelle als verarbeitet
        table.classList.add('responsive-processed');
    });
    
    console.log('Responsive Tables: ' + tables.length + ' Tabellen verarbeitet');
    
    // Spezielle Behandlung für .bionic-table-wrapper Tabellen
    const bionicTables = document.querySelectorAll('.bionic-table-wrapper table');
    console.log('Bionic Science Tables gefunden: ' + bionicTables.length);
});

