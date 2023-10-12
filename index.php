<?php
require 'Library.php'; // Include the Library class

$library = new Library();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['register-book'])) {
    $bookTitle = $_POST['book-title'];
    $bookAuthor = $_POST['book-author'];
    $bookPages = $_POST['book-pages'];
    $bookCode = $_POST['book-code'];
    $bookISBN = $_POST['book-isbn'];
    $bookPublisher = $_POST['book-publisher'];
    $library->registerBook($bookTitle, $bookAuthor, $bookPages, $bookCode, $bookISBN, $bookPublisher);
  } elseif (isset($_POST['register-user'])) {
    $userName = $_POST['user-name'];
    $userCode = $_POST['user-code'];
    $userPhone = $_POST['user-phone'];
    $userAddress = $_POST['user-address'];
    $library->registerUser($userName, $userCode, $userPhone, $userAddress);
  } elseif (isset($_POST['assign-book'])) {
    $selectedUser = $_POST['user-select'];
    $selectedBook = $_POST['book-select'];
    $loanDate = $_POST['loan-date'];
    $returnDate = $_POST['return-date'];
    $library->assignBook($selectedUser, $selectedBook, $loanDate, $returnDate);
  }
}

$assignedBooks = $library->getAssignedBooks();
$bookList = $library->getBookList();
$userList = $library->getUserList();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Tu Biblioteca Web</title>
</head>

<body>
  <header>
    <div class="logo">
      <img src="https://source.unsplash.com/150x150/?logo" alt="Logo de la biblioteca" />
    </div>
    <h1>Tu Biblioteca Web</h1>
  </header>

  <div class="container">
    <section class="librarian-section">
      <h2>Área de Bibliotecario</h2>
      <form id="book-registration-form" method="post">
        <label for="book-title">Título del Libro:</label>
        <input type="text" id="book-title" name="book-title" required placeholder="Ingrese el título del libro" />

        <label for="book-author">Autor:</label>
        <input type="text" id="book-author" name="book-author" required placeholder="Ingrese el nombre del autor" />

        <label for="book-pages">Número de Páginas:</label>
        <input type="number" id="book-pages" name="book-pages" required placeholder="Ingrese el número de páginas" />

        <label for="book-code">Código del Libro:</label>
        <input type="text" id="book-code" name="book-code" required placeholder="Ingrese el código del libro" />

        <label for="book-isbn">ISBN:</label>
        <input type="text" id="book-isbn" name="book-isbn" required placeholder="Ingrese el ISBN del libro" />

        <label for="book-publisher">Editorial:</label>
        <input type="text" id="book-publisher" name="book-publisher" required placeholder="Ingrese la editorial del libro" />

        <button type="submit" name="register-book">Registrar Libro</button>
      </form>
    </section>

    <section class="middle-column">
      <h2>Asignar Libro a Usuario</h2>
      <form id="assign-book-form" method="post">
        <label for="user-select">Seleccionar Usuario:</label>
        <select id="user-select" name="user-select">
          <?php foreach ($userList as $user) { ?>
            <option value="<?= $user['code'] ?>"><?= $user['name'] ?></option>
          <?php } ?>
        </select>

        <label for="book-select">Seleccionar Libro:</label>
        <select id="book-select" name="book-select">
          <?php foreach ($bookList as $book) { ?>
            <option value="<?= $book['title'] ?>"><?= $book['title'] ?> - <?= $book['author'] ?></option>
          <?php } ?>
        </select>

        <label for="loan-date">Fecha de Préstamo:</label>
        <input type="date" id="loan-date" name="loan-date" required value="2023-09-19" />

        <label for="return-date">Fecha de Devolución:</label>
        <input type="date" id="return-date" name="return-date" required value="2023-09-26" />

        <button type="submit" name="assign-book">Asignar Libro</button>
      </form>
    </section>

    <section class="user-section">
      <h2>Área de Usuario</h2>
      <form id="user-registration-form" method="post">
        <label for="user-name">Nombre del Usuario:</label>
        <input type="text" id="user-name" name="user-name" required placeholder="Ingrese el nombre del usuario" />

        <label for="user-code">Código del Usuario:</label>
        <input type="text" id="user-code" name="user-code" required placeholder="Ingrese el código del usuario" />

        <label for="user-phone">Teléfono:</label>
        <input type="tel" id="user-phone" name="user-phone" required placeholder="Ingrese el número de teléfono" />

        <label for="user-address">Dirección:</label>
        <input type="text" id="user-address" name="user-address" required placeholder="Ingrese la dirección del usuario" />

        <button type="submit" name="register-user">Registrar Usuario</button>
      </form>

      <!-- <div class="search-section">
        <h2>Buscar Ejemplar</h2>
        <input type="text" id="search-input" placeholder="Buscar por código o localización" />
        <button id="search-button">Buscar</button>
      </div> -->
    </section>
  </div>

  <section class="book-list">
    <h2>Lista de Libros Registrados</h2>
    <!-- Agregar un botón para exportar la lista a Excel -->
    <button id="export-book-list" class="mt">Exportar a Excel</button>
    <!-- Convert the unordered list (ul) to a table (table) -->
    <table id="book-list-table">
      <tbody>
        <tr>
          <th>Título del Libro</th>
          <th>Autor</th>
          <th>Número de Páginas</th>
          <th>Código del Libro</th>
          <th>ISBN</th>
          <th>Editorial</th>
        </tr>
        <?php foreach ($bookList as $book) { ?>
          <tr>
            <td><?= $book['title'] ?></td>
            <td><?= $book['author'] ?></td>
            <td><?= $book['pages'] ?></td>
            <td><?= $book['code'] ?></td>
            <td><?= $book['isbn'] ?></td>
            <td><?= $book['publisher'] ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </section>

  <section class="user-list">
    <h2>Lista de Usuarios Registrados</h2>
    <!-- Agregar un botón para exportar la lista a Excel -->
    <button id="export-user-list">Exportar a Excel</button>
    <table id="user-list-table">
      <thead>
        <tr>
          <th>Nombre del Usuario</th>
          <th>Código del Usuario</th>
          <th>Teléfono</th>
          <th>Dirección</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($userList as $user) { ?>
          <tr>
            <td><?= $user['name'] ?></td>
            <td><?= $user['code'] ?></td>
            <td><?= $user['phone'] ?></td>
            <td><?= $user['address'] ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>


  </section>

  <section class="assigned-list">
    <h2>Lista de Libros asignados</h2>
    <!-- Agregar un botón para exportar la lista a Excel -->
    <button id="export-assigned-list">Exportar a Excel</button>
    <table id="assigned-list-table">
      <thead>
        <tr>
          <th>Nombre del Usuario</th>
          <th>Título del Libro</th>
          <th>Fecha de Préstamo</th>
          <th>Fecha de Devolución</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($userList as $user) { ?>
          <?php foreach ($assignedBooks as $assignedBook) { ?>
            <?php if ($assignedBook['user_code'] == $user['code']) { ?>
              <tr>
                <td><?= $user['name'] ?></td>
                <td><?= $assignedBook['book_title'] ?></td>
                <td><?= $assignedBook['loan_date'] ?></td>
                <td><?= $assignedBook['return_date'] ?></td>
              </tr>
            <?php } ?>
          <?php } ?>
        <?php } ?>
      </tbody>
    </table>
  </section>

</body>
<footer>
  <p>
    Tu Biblioteca Web &copy; 2023 -
    <a href="mailto:alex.henaof@gmail.com">Axel</a>
  </p>
</footer>

<script src="xlsx.full.min.js"></script>
<script src="script.js"></script>

</html>