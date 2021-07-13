<style>
.admin a{
  color: white;
}

  .admin{
    background: #1f2024;
    color: white;
  }
  .admin-content {
    display: flex;
    position: relative;
    z-index: 20;
    justify-content: space-between;
    font-family: 'Roboto';
  }
  .admin .admin-content > a{
    padding: 10px;
  }

</style>
<div class="admin ">
  <div class="admin-content wrapper-inner">
    <a href="<?php echo "https://$_SERVER[HTTP_HOST]/admin" ?>">
      <div class="add-category">
        <span>Привет, администратор</span>
      </div>
    </a>
    <a href="<?php echo "https://$_SERVER[HTTP_HOST]/admin" ?>">
      <div class="add-category">
        <span>Консоль</span>
      </div>
    </a></div>
</div>
