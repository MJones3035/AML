<!DOCTYPE html>
<html lang="en">



<body class="d-flex flex-column min-vh-100">

    <?php include("header.php"); ?>

    <style>
        #bookTable tbody tr {
            display: none;
            /* Start with rows hidden for filter effect */
        }

        #bookTable tbody tr.visible {
            display: table-row;
            /* Only show rows that match the filter */
        }
    </style>

    <main class="container pt-5 pb-5">

        <div class="container mt-5">
            <h1 class="text-center mb-4">Media Catalogue</h1>

            <!-- Search Bar -->
            <div class="mb-3">
                <input type="text" id="bookSearch" class="form-control" placeholder="Search for media by title, author, or genre...">
            </div>

            <!-- Books Table -->
            <table class="table table-dark table-hover table-bordered" id="bookTable">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Genre</th>
                        <th>Year</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>The Hobbit</td>
                        <td>J.R.R. Tolkien</td>
                        <td>Fantasy</td>
                        <td>1937</td>
                    </tr>
                    <tr>
                        <td>To Kill a Mockingbird</td>
                        <td>Harper Lee</td>
                        <td>Fiction</td>
                        <td>1960</td>
                    </tr>
                    <tr>
                        <td>1984</td>
                        <td>George Orwell</td>
                        <td>Dystopian</td>
                        <td>1949</td>
                    </tr>
                    <tr>
                        <td>Pride and Prejudice</td>
                        <td>Jane Austen</td>
                        <td>Romance</td>
                        <td>1813</td>
                    </tr>
                    <tr>
                        <td>Frankenstein</td>
                        <td>Mary Shelley</td>
                        <td>Horror</td>
                        <td>1818</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </main>
    <!-- Filtering -->
    <script>
        document.getElementById("bookSearch").addEventListener("input", function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll("#bookTable tbody tr");

            rows.forEach(row => {
                const cells = Array.from(row.querySelectorAll("td"));
                const matches = cells.some(cell => cell.textContent.toLowerCase().includes(searchValue));
                row.classList.toggle("visible", matches);
            });
        });

        // Show all rows initially
        document.addEventListener("DOMContentLoaded", () => {
            const rows = document.querySelectorAll("#bookTable tbody tr");
            rows.forEach(row => row.classList.add("visible"));
        });
    </script>

    <?php include("footer.php") ?>

</body>

</html>