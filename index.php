<?php

$hotels = [
  // INDICE 0
  [
    'name' => 'Hotel Belvedere',
    'description' => 'Hotel Belvedere Descrizione',
    'parking' => true,
    'vote' => 4,
    'distance_to_center' => 10.4
  ],
  // INDICE 1
  [
    'name' => 'Hotel Futuro',
    'description' => 'Hotel Futuro Descrizione',
    'parking' => true,
    'vote' => 2,
    'distance_to_center' => 2
  ],
  // INDICE 2
  [
    'name' => 'Hotel Rivamare',
    'description' => 'Hotel Rivamare Descrizione',
    'parking' => false,
    'vote' => 1,
    'distance_to_center' => 1
  ],
  // INDICE 3
  [
    'name' => 'Hotel Bellavista',
    'description' => 'Hotel Bellavista Descrizione',
    'parking' => false,
    'vote' => 5,
    'distance_to_center' => 5.5
  ],
  // INDICE 4
  [
    'name' => 'Hotel Milano',
    'description' => 'Hotel Milano Descrizione',
    'parking' => true,
    'vote' => 2,
    'distance_to_center' => 50
  ],
];

$has_filters = !empty($_GET);

if ($has_filters) {
  $filters = $_GET;

  if (isset($filters['parking'])) {
    if ($filters['parking'] != 'both') {
      $temp_hotels = [];
      foreach ($hotels as $hotel) {
        if ((bool) $filters['parking'] === $hotel['parking']) {
          $temp_hotels[] = $hotel;
        }
      }

      $hotels = $temp_hotels;
    }
  }

  if (isset($filters['vote'])) {
    $temp_hotels = [];
    foreach ($hotels as $hotel) {
      if ($hotel['vote'] >= (int) $filters['vote']) {
        $temp_hotels[] = $hotel;
      }
    }

    $hotels = $temp_hotels;
  }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LC PHP</title>

  <!-- Bootstrap 5.3.0 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />

  <!-- Font-awesome 6.4.2 -->
  <!-- <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    /> -->

  <!-- Custom style -->
  <link rel="stylesheet" href="./css/style.css" />
</head>

<body>
  <div class="container mt-5">

    <div class="card mb-3">
      <div class="card-header">
        <h2>Filtri</h2>
      </div>
      <div class="card-body">
        <form method="GET">

          <div class="mb-3">
            <label for="parking" class="mb-2">Parcheggio</label>
            <select name="parking" id="parking" required class="form-select">
              <option value="">Seleziona ...</option>
              <option value="0" <?php echo "0" == ($filters['parking'] ?? '') ? 'selected' : '' ?>>Senza parcheggio
              </option>
              <option value="1" <?php echo "1" == ($filters['parking'] ?? '') ? 'selected' : '' ?>>Con parcheggio
              </option>
              <option value="both" <?php echo "both" == ($filters['parking'] ?? '') ? 'selected' : '' ?>>Entrambi
              </option>
            </select>
          </div>

          <div class="mb-3">
            <label for="vote" class="mb-2">Voto</label>
            <input type="number" min="0" max="5" step="1" name="vote" id="vote" class="form-control"
              value="<?php echo $filters['vote'] ?? '' ?>" />
          </div>

          <button class="btn btn-primary">Filtra</button>
          <input type="reset" value="Reset" class="btn btn-secondary" />
        </form>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h2>Hotel list</h2>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nome</th>
              <th scope="col">Descrizione</th>
              <th scope="col">Parcheggio</th>
              <th scope="col">Voto</th>
              <th scope="col">Distanza dal centro</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($hotels as $index => $hotel): ?>

              <tr>
                <th scope="row">
                  <?php echo $index + 1 ?>
                </th>
                <td>
                  <?php echo $hotel['name'] ?>
                </td>
                <td>
                  <?php echo $hotel['description'] ?>
                </td>
                <td>
                  <?php echo $hotel['parking'] ? 'Sì' : 'No' ?>
                </td>
                <td>
                  <?php echo $hotel['vote'] ?>
                </td>
                <td>
                  <?php echo $hotel['distance_to_center'] ?>
                </td>
              </tr>

            <?php endforeach; ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>