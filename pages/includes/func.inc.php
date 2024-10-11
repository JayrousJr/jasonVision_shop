<?php
// split_time
if (!function_exists('split_time')) {
  function split_time($time)
  {
    $new = explode(" ", $time);
    return $new;
  }
}
// Displayed Invoice Number
function inv_display($invoice_No)
{
  switch (strlen($invoice_No)) {
    case 1:
      $invoice_No = "0000" . $invoice_No;
      break;
    case 2:
      $invoice_No = "000" . $invoice_No;
      break;
    case 3:
      $invoice_No = "00" . $invoice_No;
      break;
    case 4:
      $invoice_No = "0" . $invoice_No;
      break;
    default:
      $invoice_No = $invoice_No + 1;
  }
  return $invoice_No;
}

/**
 * GET next table ID
 * 
 * @deprecated
 * @return next ID
 */
function getID($conn, $table)
{
  $sql = mysqli_query($conn, "SELECT id FROM {$table} ORDER BY id DESC LIMIT 1");
  if (mysqli_num_rows($sql) > 0) {
    $data = mysqli_fetch_array($sql);
    $id = $data['id'] + 1;
  } else {
    $id = 1;
  }
  return $id;
}

function getNextInvoiceNumber()
{
  global $conn;
  $sql = mysqli_query($conn, "SELECT invoice_id FROM invoice_number ORDER BY invoice_id DESC LIMIT 1");
  return mysqli_num_rows($sql) > 0 ? mysqli_fetch_array($sql)[0] + 1 : 1;
}

// Delete with id
function delete($conn, $table, $id, $col = 'id')
{
  return mysqli_query($conn, "DELETE FROM {$table} WHERE {$col} = '$id'");
}

// Check if unique field exist
if (!function_exists('isExist')) {
  function isExist($conn, $table, $field, $value)
  {
    $check = mysqli_query($conn, "SELECT * FROM {$table} WHERE {$field} = '{$value}'");
    if (mysqli_num_rows($check) > 0) {
      return true;
    }
    return false;
  }
}

/**
 * Render POS product Table
 * @param mysqli results - required
 * @return product tables|string
 *************************************************************************************/
function render_pos_table($sql)
{
  $tbody = '';
  if (mysqli_num_rows($sql) > 0) {
    $i = 1;
    while ($row = mysqli_fetch_assoc($sql)) {
      $id = $row['id'];
      $name = $row['dname'];
      $cat = $row['category'];
      $stock = $row['quantity'];
      $price = $row['sprice'];

      $tbody .= '
            <tr>
              <td>' . $name . '</td>
              <td>' . $cat . '</td>
              <td>' . number_format($price) . '</td>
              <td>' . $stock . '</td>
              <td width="10%">
                <button type="button" id="sellBtn" onclick="sell(' . $id . ')" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-shopping-cart"></span> Add
                </button>
              </td>
            </tr>';
      $i++;
    }
  } else {
    $tbody = "<tr><td colspan='4' class='text-center'>There is no registered stocks!</td></tr>";
  }

  return $tbody;
}

/**
 * Get Cart Items
 * @param user_id:int
 * @return All cart for this user:Array
 **************************************************************************************/
function get_cart_items($user_id)
{
  global $conn;
  $sql = mysqli_query($conn, "SELECT * FROM soud WHERE user_id = '" . $user_id . "'");
  if (mysqli_num_rows($sql) > 0)
    return mysqli_fetch_assoc($retr);
  return [];
}

/**
 * Get All Items
 * @param user_id:int
 * @return All cart for this user:Array
 **************************************************************************************/
function get_all($table, $current_page = false, $limit = false)
{
  global $conn;
  if ($current_page == FALSE || $limit == FALSE) {
    $offset = 0;
    $limit = '';
  } else {
    $offset = ($current_page - 1) * $limit;
    $limit = "LIMIT " . $offset . ',' . $limit;
  }
  $sql = mysqli_query($conn, "SELECT * FROM {$table} {$limit}");
  if (mysqli_num_rows($sql) > 0)
    return mysqli_fetch_all($sql, MYSQLI_ASSOC);
  return [];
}

/**
 * Pagination
 * @param Table, Current Page, Url
 * @return All cart for this user:Array
 **************************************************************************************/
function get_pagination_links($table, $current_page, $url)
{
  global $conn;
  $sql = mysqli_query($conn, "SELECT * FROM {$table}");
  $total_pages = ceil($sql->num_rows / 10);

  $links = "";
  if ($total_pages >= 1 && $current_page <= $total_pages) {
    $links .= "<li><a href=\"{$url}?page=1\">1</a></li>";
    $i = max(2, $current_page - 5);
    if ($i > 2)
      $links .= "<li><a>...</a></li>";
    for (; $i < min($current_page + 6, $total_pages); $i++) {
      $links .= "<li><a href=\"{$url}?page={$i}\">{$i}</a></li>";
    }
    if ($i != $total_pages)
      $links .= "<li><a>...</a></li>";
    $links .= "<li><a href=\"{$url}?page={$total_pages}\">{$total_pages}</a></li>";
  }
  return $links;
}

function pagination($table, $current_page, $url)
{
  return '<nav aria-label="Page navigation">
    <ul class="pagination">
      <li>
        <a href="#" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      ' . get_pagination_links($table, $current_page, $url) . '
      <li>
        <a href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>';
}