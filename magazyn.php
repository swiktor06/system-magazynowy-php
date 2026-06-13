<?php
include 'db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['akcja_edytuj'])) {
    $id_produktu = (int)$_POST['id_produktu'];
    $nowa_ilosc = (int)$_POST['nowa_ilosc'];


    if ($nowa_ilosc >= 0) {

        $stmt = $pdo->prepare("UPDATE produkty SET ilosc = :ilosc WHERE id = :id");
        $stmt->execute([
            'ilosc' => $nowa_ilosc,
            'id' => $id_produktu
        ]);
        

        header("Location: magazyn.php" . (isset($_GET['sortowanie']) ? "?sortowanie=" . $_GET['sortowanie'] : ""));
        exit;
    }
}

$order = "id ASC";
if (isset($_GET['sortowanie'])) {
    switch ($_GET['sortowanie']) {
        case 'id_rosnaco':
            $order = "id ASC";
            break;
        case 'cena_m':
            $order = "cena DESC";
            break;
        case 'cena_r':
            $order = "cena ASC";
            break;
        case 'ilosc_m':
            $order = "ilosc DESC";
            break;
        case 'ilosc_r':
            $order = "ilosc ASC";
            break;
    }
}        
$query = $pdo->query("SELECT * FROM produkty ORDER BY $order");
$produkty = $query->fetchAll();

include 'header.php';
?>
<main>
    <div style="max-width: 1100px;">
        <h1>Magazyn</h1>
        <p>Poniższa tabela przedstawia aktualny stan magazynu, wraz z ilością dostępnych produktów oraz ich cenami.
        </p>
        <p>
            W momencie gdy ilość produktu spadnie poniżej 5 sztuk, zostanie on oznaczony jako <span style="color: orange;">"Niski stan"</span>. W przypadku braku produktu w magazynie, zostanie on oznaczony jako <span style="color: red;">"Brak"</span>.
        </p>
        <p>
            Można również zmienić ilość produktów bezpośrednio w tabeli, wpisując nową wartość w polu obok przycisku "Zmień" i klikając go.
        </p>
        <p>
            Możemy również posortować produkty według ID, ceny lub ilości, korzystając z rozwijanego menu powyżej tabeli.
        </p>
        
        <div class="sortowanie" style="margin-bottom: 20px; padding: 10px; background: rgba(255, 255, 255, 0.1); border-radius: 10px; max-width: 400px;">
            <form method="GET" action="magazyn.php" id="sortowanieform">
                <label for="sortowanie" style="font-size:14pt; color: black;">Sortuj według:</label>
                <select id="sortowanie" name="sortowanie" onchange="this.form.submit()" style="background-image: linear-gradient(135deg, #40699b, #2c4071, #0f1c3f); color:white; border: 1px solid rgba(255, 255, 255, 0.25); border-radius: 5px; padding: 10px;">
                    <option value="id_rosnaco" <?php echo (isset($_GET['sortowanie']) && $_GET['sortowanie'] == 'id_rosnaco') ? 'selected' : '' ?> style="background: #2a4d6c; color: white;">ID (rosnąco)</option>
                    <option value="cena_m" <?php echo (isset($_GET['sortowanie']) && $_GET['sortowanie'] == 'cena_m') ? 'selected' : '' ?> style="background: #2a4d6c; color: white;">Cena (malejąco)</option>
                    <option value="cena_r" <?php echo (isset($_GET['sortowanie']) && $_GET['sortowanie'] == 'cena_r') ? 'selected' : '' ?> style="background: #2a4d6c; color: white;">Cena (rosnąco)</option>
                    <option value="ilosc_m" <?php echo (isset($_GET['sortowanie']) && $_GET['sortowanie'] == 'ilosc_m') ? 'selected' : '' ?> style="background: #2a4d6c; color: white;">Ilość (malejąco)</option>
                    <option value="ilosc_r" <?php echo (isset($_GET['sortowanie']) && $_GET['sortowanie'] == 'ilosc_r') ? 'selected' : '' ?> style="background: #2a4d6c; color: white;">Ilość (rosnąco)</option>
                </select>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nazwa</th>
                    <th>Kategoria</th>
                    <th>Ilość</th>
                    <th>Cena</th>
                    <th>Status</th>
                    <th>Akcja</th> </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($produkty as $produkt) {
                        if ($produkt['ilosc'] == 0) {
                            $status = "Brak";
                            $status_color = "red";
                        } elseif ($produkt['ilosc'] < 5) {
                            $status = "Niski stan";
                            $status_color = "orange";
                        } else {
                            $status = "Dostępny";
                            $status_color = "green";
                        }
                        echo "<tr>";
                        echo "<td>" . $produkt['id'] . "</td>";
                        echo "<td>" . htmlspecialchars($produkt['nazwa']) . "</td>";
                        echo "<td>" . htmlspecialchars($produkt['kategoria']) . "</td>";
                        echo "<td>" . $produkt['ilosc'] . "</td>";
                        echo "<td>" . number_format($produkt['cena'], 2, ',', ' ') . " zł</td>";
                        echo "<td class='" . $status_color . "'>" . $status . "</td>";
                        
                        echo "<td>";
                        echo "<form method='POST' action='magazyn.php' style='display: flex; gap: 5px; align-items: center;'>";
                        echo "<input type='hidden' name='id_produktu' value='" . $produkt['id'] . "'>";
                        echo "<input type='number' name='nowa_ilosc' value='" . $produkt['ilosc'] . "' min='0' style='width: 60px; padding: 5px; border-radius: 4px; border: 1px solid rgba(255,255,255,0.3); background: rgba(255,255,255,0.2); color: white; text-align: center;'>";
                        echo "<button type='submit' name='akcja_edytuj' style='padding: 5px 10px; background: #40699b; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 10pt;'>Zmień</button>";
                        echo "</form>";
                        echo "</td>";

                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</main>
<?php
include 'footer.php';
?>