<?php require_once APPPATH . 'views/layouts/header.php'; ?>

<div class="d-flex justify-content-between">
    <h1>List</h1>
    <div class="d-flex justify-content-between">
      <div>
        <a href="<?= base_url('/') ?>" class="btn btn-success" name="">Form</a>
        <a href="<?= base_url('/logs') ?>" class="btn btn-danger" name="">Logs</a>
      </div>
    </div>
</div>
<hr>

<form action="<?= base_url('filter') ?>" class="d-flex justify-content-between">
    <div class="mb-3 col-md-3">
        <select class="form-select" name="role" id="role" aria-label="Default select example">
            <option value="">Vəzifəniz</option>
            <?php
            if (isset($roles) && count($roles)>0) {
              foreach ($roles as  $role ){
                  ?>
                  <option <?php echo $role->id == $this->input->get("role") ?
                  'selected' : '' ?> value="<?= $role->id ?>">
                  <?= $role->name ?></option>
              <?php
            }
            }
            ?>
        </select>
    </div>
    <div class="mb-3 col-md-3">
        <input type="number" step="0.01" class="form-control"  name="min_salary" value="<?= $_GET['min_salary'] ?? ''; ?>" id="min_salary" placeholder="Minimum Maaş">
    </div>
    <div class="mb-3 col-md-3">
        <input type="number" step="0.01" class="form-control" name="max_salary" value="<?= $_GET['max_salary'] ?? ''; ?>" id="max_salary" placeholder="Maksimum Maaş">
    </div>
    <div class="">
      <input class="form-control me-2" type="search" value="<?= $_GET['search_text'] ?? ''; ?>" name="search_text" id="search" placeholder="Ad və Soyada görə axtarış" aria-label="Search">
      <input class="btn btn-outline-success me-3 col-md-12" value="Axtar" type="submit" ></input>
      <input class="btn btn-outline-danger me-3 col-md-12" value="Reset" id="resetFilter" type="button" ></input>
      <div id="suggestions-container"></div>
    </div>
</form>

<hr>


<table class="table">
    <thead>
    <tr>
        <th scope="col">Ad</th>
        <th scope="col">Soyad</th>
        <th scope="col">Maaş</th>
        <th scope="col">Başlama Vaxtı</th>
        <th scope="col">Vəzifə</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (isset($employees) && count($employees)>0){
    foreach ($employees as $employee) {
        ?>
        <tr>
            <td><?= $employee->name ?></td>
            <td><?= $employee->surname ?></td>
            <td><?= $employee->salary ?> AZN</td>
            <td><?= $employee->date ?></td>
            <td><?= $employee->role_name ?></td>
        </tr>
        <?php
    }
    }
    ?>
    <?php
 if (isset($filter) && count($filter) > 0) {
     foreach ($filter as $data) {
         ?>
         <tr>
             <td><?= $data->name ?></td>
             <td><?= $data->surname ?></td>
             <td><?= $data->salary ?> AZN</td>
             <td><?= $data->date ?></td>
             <td><?= $data->role_name ?></td>
         </tr>
         <?php
     }
 }
 ?>
 </tbody>
</table>
<?php
if (isset($filter) && count($filter) == 0) { ?>
 <div class="alert alert-warning">Məlumat tapılmadı!</div>
<?php }
?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(document).ready(function() {

        $('#resetFilter').click(function () {
        $('#max_salary').val('');
        $('#min_salary').val('');
        $('#search_text').val('');
        $('#role')[0].selectedIndex = 0;

        let currentUrl = window.location.href;

        // Parametreleri temizle
        let newUrl = removeURLParameters(currentUrl);

        // Yeni URL'ye yönlendir
        window.location.href = newUrl;
    });

    function removeURLParameters(url) {
        var urlParts = url.split('?');
        return urlParts[0]; // Parametreler olmadan URL'yi geri döndür
    }
    
</script>

<?php require_once APPPATH . 'views/layouts/footer.php'; ?>
