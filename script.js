document.addEventListener("DOMContentLoaded", function () {
  // Configura la exportación para la lista de libros
  const bookListExportButton = document.getElementById("export-book-list");
  bookListExportButton.addEventListener("click", function () {
    exportTableToXLSX("book-list-table", "book_list.xlsx");
  });

  // Configura la exportación para la lista de usuarios
  const userListExportButton = document.getElementById("export-user-list");
  userListExportButton.addEventListener("click", function () {
    exportTableToXLSX("user-list-table", "user_list.xlsx");
  });

  // Configura la exportación para la lista de asignados
  const assignedListExportButton = document.getElementById("export-assigned-list");
  assignedListExportButton.addEventListener("click", function () {
    exportTableToXLSX("assigned-list-table", "assigned_list.xlsx");
  });

  function exportTableToXLSX(tableId, fileName) {
    const table = document.getElementById(tableId);
    const ws = XLSX.utils.table_to_sheet(table);
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Sheet 1");
    XLSX.writeFile(wb, fileName);
  }
});
