<?php
/******************************
 * Config
 ******************************/
const FILE_DB = __DIR__ . '/comics.json'; // almacenamiento "texto" (JSON)

/******************************
 * Utilidades de datos
 ******************************/
function loadComics(): array {
    if (!file_exists(FILE_DB)) return [];
    $json = file_get_contents(FILE_DB);
    $arr = json_decode($json, true);
    return is_array($arr) ? $arr : [];
}

function saveComics(array $comics): void {
    file_put_contents(FILE_DB, json_encode($comics, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function uuid(): string {
    // id simple legible (timestamp + aleatorio). Suficiente para este caso.
    return dechex(time()) . '-' . bin2hex(random_bytes(4));
}

function sanitize(string $s): string {
    return trim($s);
}

function allowedEstado(string $estado): string {
    $estado = strtolower($estado);
    $permitidos = ['pendiente', 'leyendo', 'leído', 'leido']; // acepta sin acento
    if (!in_array($estado, $permitidos, true)) return 'pendiente';
    // normaliza 'leido' -> 'leído'
    return $estado === 'leido' ? 'leído' : $estado;
}

function toBool($v): bool {
    return filter_var($v, FILTER_VALIDATE_BOOLEAN);
}

/******************************
 * Operaciones (CRUD)
 ******************************/
function addComic(string $titulo, string $autor, string $estado, bool $prestado, string $localizacion): void {
    $comics = loadComics();
    $comics[] = [
        'id'           => uuid(),
        'titulo'       => $titulo,
        'autor'        => $autor,
        'estado'       => allowedEstado($estado),
        'prestado'     => $prestado,
        'localizacion' => $localizacion,
    ];
    saveComics($comics);
}

function deleteComicByIdOrTitle(string $ident): bool {
    $comics = loadComics();
    $identNorm = mb_strtolower($ident);
    $new = [];
    $removed = false;

    foreach ($comics as $c) {
        if (mb_strtolower($c['id']) === $identNorm || mb_strtolower($c['titulo']) === $identNorm) {
            $removed = true;
            continue;
        }
        $new[] = $c;
    }
    if ($removed) saveComics($new);
    return $removed;
}

function updateEstado(string $ident, string $nuevoEstado): bool {
    $comics = loadComics();
    $identNorm = mb_strtolower($ident);
    $ok = false;

    foreach ($comics as &$c) {
        if (mb_strtolower($c['id']) === $identNorm || mb_strtolower($c['titulo']) === $identNorm) {
            $c['estado'] = allowedEstado($nuevoEstado);
            $ok = true;
            break;
        }
    }
    if ($ok) saveComics($comics);
    return $ok;
}

function updatePrestado(string $ident, bool $prestado): bool {
    $comics = loadComics();
    $identNorm = mb_strtolower($ident);
    $ok = false;

    foreach ($comics as &$c) {
        if (mb_strtolower($c['id']) === $identNorm || mb_strtolower($c['titulo']) === $identNorm) {
            $c['prestado'] = $prestado;
            $ok = true;
            break;
        }
    }
    if ($ok) saveComics($comics);
    return $ok;
}

function updateLocalizacion(string $ident, string $loc): bool {
    $comics = loadComics();
    $identNorm = mb_strtolower($ident);
    $ok = false;

    foreach ($comics as &$c) {
        if (mb_strtolower($c['id']) === $identNorm || mb_strtolower($c['titulo']) === $identNorm) {
            $c['localizacion'] = $loc;
            $ok = true;
            break;
        }
    }
    if ($ok) saveComics($comics);
    return $ok;
}

/******************************
 * Render HTML helpers
 ******************************/
function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

function renderTable(array $comics): string {
    if (empty($comics)) return "<p>No hay cómics registrados.</p>";
    $rows = '';
    foreach ($comics as $c) {
        $rows .= "<tr>
            <td><code>".h($c['id'])."</code></td>
            <td>".h($c['titulo'])."</td>
            <td>".h($c['autor'])."</td>
            <td>".h($c['estado'])."</td>
            <td>".($c['prestado'] ? 'Sí' : 'No')."</td>
            <td>".h($c['localizacion'])."</td>
        </tr>";
    }
    return "<table border='1' cellpadding='6' cellspacing='0'>
        <thead>
          <tr>
            <th>ID</th><th>Título</th><th>Autor</th><th>Estado</th><th>Prestado</th><th>Localización</th>
          </tr>
        </thead>
        <tbody>{$rows}</tbody>
    </table>";
}

/******************************
 * Controlador (acciones)
 ******************************/
$accion = $_POST['accion'] ?? '';
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($accion === 'agregar-guardar') {
        $titulo = sanitize($_POST['titulo'] ?? '');
        $autor  = sanitize($_POST['autor'] ?? '');
        $estado = allowedEstado($_POST['estado'] ?? 'pendiente');
        $prestado = toBool($_POST['prestado'] ?? false);
        $loc = sanitize($_POST['localizacion'] ?? '');

        if ($titulo === '' || $autor === '') {
            $msg = "<p style='color:red'>Título y autor son obligatorios.</p>";
        } else {
            addComic($titulo, $autor, $estado, $prestado, $loc);
            $msg = "<p style='color:green'>Cómic '".h($titulo)."' agregado.</p>";
        }
    }

    if ($accion === 'eliminar-guardar') {
        $ident = sanitize($_POST['ident'] ?? '');
        if ($ident === '') {
            $msg = "<p style='color:red'>Debes indicar ID o título para eliminar.</p>";
        } else {
            $ok = deleteComicByIdOrTitle($ident);
            $msg = $ok ? "<p style='color:green'>Cómic eliminado.</p>" : "<p style='color:red'>No encontrado.</p>";
        }
    }

    if ($accion === 'estado-guardar') {
        $ident = sanitize($_POST['ident'] ?? '');
        $nuevo = allowedEstado($_POST['nuevo_estado'] ?? '');
        if ($ident === '') {
            $msg = "<p style='color:red'>Indica ID o título.</p>";
        } else {
            $ok = updateEstado($ident, $nuevo);
            $msg = $ok ? "<p style='color:green'>Estado actualizado.</p>" : "<p style='color:red'>No encontrado.</p>";
        }
    }

    if ($accion === 'prestado-guardar') {
        $ident = sanitize($_POST['ident'] ?? '');
        $prest = toBool($_POST['nuevo_prestado'] ?? false);
        if ($ident === '') {
            $msg = "<p style='color:red'>Indica ID o título.</p>";
        } else {
            $ok = updatePrestado($ident, $prest);
            $msg = $ok ? "<p style='color:green'>Campo 'prestado' actualizado.</p>" : "<p style='color:red'>No encontrado.</p>";
        }
    }

    if ($accion === 'loc-guardar') {
        $ident = sanitize($_POST['ident'] ?? '');
        $loc = sanitize($_POST['nueva_loc'] ?? '');
        if ($ident === '' || $loc === '') {
            $msg = "<p style='color:red'>Indica ID/título y nueva localización.</p>";
        } else {
            $ok = updateLocalizacion($ident, $loc);
            $msg = $ok ? "<p style='color:green'>Localización actualizada.</p>" : "<p style='color:red'>No encontrado.</p>";
        }
    }
}

/******************************
 * Vista
 ******************************/
$comics = loadComics();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Gestión de Cómics</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 24px; }
    .panel { border: 1px solid #ccc; padding: 12px; margin-bottom: 16px; border-radius: 6px; }
    h2 { margin: 0 0 12px 0; }
    form > div { margin: 6px 0; }
    input[type="text"] { width: 280px; }
    table { border-collapse: collapse; width: 100%; }
    th { background: #f5f5f5; }
  </style>
</head>
<body>
  <h1>Gestión de colección de cómics</h1>

  <?= $msg ?>

  <div class="panel">
    <h2>1) Agregar nuevo cómic</h2>
    <form method="post">
      <div>
        <label>Título: <input type="text" name="titulo" required></label>
      </div>
      <div>
        <label>Autor: <input type="text" name="autor" required></label>
      </div>
      <div>
        <label>Estado:
          <select name="estado">
            <option value="pendiente">pendiente</option>
            <option value="leyendo">leyendo</option>
            <option value="leído">leído</option>
          </select>
        </label>
      </div>
      <div>
        <label>Prestado:
          <select name="prestado">
            <option value="false">No</option>
            <option value="true">Sí</option>
          </select>
        </label>
      </div>
      <div>
        <label>Localización:
          <select name="localizacion">
            <option value="estanteria1">estanteria1</option>
            <option value="estanteria2">estanteria2</option>
            <option value="mueble">mueble</option>
          </select>
        </label>
      </div>
      <button type="submit" name="accion" value="agregar-guardar">Agregar</button>
    </form>
  </div>

  <div class="panel">
    <h2>2) Listado completo</h2>
    <?= renderTable($comics) ?>
  </div>

  <div class="panel">
    <h2>3) Eliminar cómic (por ID o título)</h2>
    <form method="post">
      <div>
        <label>Identificador o título:
          <input type="text" name="ident" placeholder="id o título exacto" required>
        </label>
      </div>
      <button type="submit" name="accion" value="eliminar-guardar">Eliminar</button>
    </form>
  </div>

  <div class="panel">
    <h2>4) Modificar estado</h2>
    <form method="post">
      <div>
        <label>Identificador o título:
          <input type="text" name="ident" required>
        </label>
      </div>
      <div>
        <label>Nuevo estado:
          <select name="nuevo_estado">
            <option value="pendiente">pendiente</option>
            <option value="leyendo">leyendo</option>
            <option value="leído">leído</option>
          </select>
        </label>
      </div>
      <button type="submit" name="accion" value="estado-guardar">Actualizar estado</button>
    </form>
  </div>

  <div class="panel">
    <h2>Actualizar “prestado”</h2>
    <form method="post">
      <div>
        <label>Identificador o título:
          <input type="text" name="ident" required>
        </label>
      </div>
      <div>
        <label>Prestado:
          <select name="nuevo_prestado">
            <option value="false">No</option>
            <option value="true">Sí</option>
          </select>
        </label>
      </div>
      <button type="submit" name="accion" value="prestado-guardar">Actualizar</button>
    </form>
  </div>

  <div class="panel">
    <h2>Actualizar localización</h2>
    <form method="post">
      <div>
        <label>Identificador o título:
          <input type="text" name="ident" required>
        </label>
      </div>
      <div>
        <label>Nueva localización:
          <select name="nueva_loc">
            <option value="estanteria1">estanteria1</option>
            <option value="estanteria2">estanteria2</option>
            <option value="mueble">mueble</option>
          </select>
        </label>
      </div>
      <button type="submit" name="accion" value="loc-guardar">Actualizar</button>
    </form>
  </div>

</body>
</html>
