<style>
.admin{

}
.admin a{
  color: white;
}

  .admin{
    display: flex;
    background: #1f2024;
    color: white;
    position: sticky;
    z-index: 20;
    justify-content: center;
    font-family: 'Roboto';
    border-bottom: 1px solid #292A2E;

  }
  .admin >a{
    padding: 10px;
  }
  .plus {
    font-weight: bold;
    padding-right: 5px;
  }
  @media (max-width: 767px) {
    .admin {
      flex-direction: column;
    }
    .admin a {
      margin: 0 auto;
    }
  }

</style>
<div class="admin ">
    <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/create-category.php'  ?>">
      <div class="add-category">
        <span class="plus">+</span>
        <span>Добавить категорию</span>
      </div>
    </a>
    <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/create-post.php'  ?>">
      <div class="add-post">
        <span class="plus">+</span>
        <span>Добавить запись</span>
      </div>
    </a>
</div>
