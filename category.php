<?php
//  Connect dtb
include('../connect.php');
if (!isset($_SESSION['username'])) {
    header('location: ../login.php');
}
$result = mysqli_query($conn, "SELECT * FROM category");
?>

<!-- Contain -->
<script src="add_category.js"></script>
<div class="gird__column-9">
    <div class="user-info">
        <p style="font-size: 20px;font-weight:600;">CATEGORY</p>
        <!-- Button trigger modal -->
        <div class="category__subnest">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop1" style="font-size: 1.6rem; margin: 0px 0px 20px 0px; padding: 8px 20px;">
                ADD
            </button>
        </div>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col" style="width: 10%;font-size:1.5rem;">ID</th>
                    <th scope="col" style="width: 30%;font-size:1.5rem;">NAME</th>
                    <th scope="col" style="width: 5%;font-size:1.5rem;">UPDATE</th>
                    <th scope="col" style="width: 5%;font-size:1.5rem;">DELETE</th>
                </tr>
            </thead>
            <tbody>
                <!-- <script>
                    function toggleModal(e, id, name) {

                        // Open the modal
                        let l = e.querySelector('.modal-toggler');
                        l.click();

                        // document.getElementById('staticBackdropLabel2').innerHTML = name;
                        document.getElementById('hahahaname').value = name;
                    }
                </script> -->
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>

                        <td style="font-size: 1.5rem;line-height:40px; height: 40px;">
                            <?php echo $row['id_category']; ?>
                        </td>

                        <td style="font-size: 1.5rem; line-height:40px; height: 40px;">
                            <?php echo $row['name'] ?>
                        </td>

                        <td style="font-size: 1.5rem; line-height:40px; height: 40px;">
                            <a class="category__link" href="/web_chiasekienthuc/manage/index.php?page_layout=update_category&modal=1&id=<?php echo $row['id_category']; ?>&name_category=<?php echo $row['name']; ?>">
                                <i class='bx bxs-edit'></i>
                            </a>
                        </td>

                        <td style="font-size: 1.5rem; line-height:40px; height: 40px;">
                            <a class="category__link" href="delete_category.php?Id=<?php echo $row['id_category']; ?>" onClick="return confirm('Do you want to delete ?');">
                                <i class='bx bx-trash-alt'></i>
                            </a>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel" style="font-size: 1.5rem;">ADD CATEGORY</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form onsubmit="return validateForm_Category();" action="/web_chiasekienthuc/manage/index.php?page_layout=add_category" method="POST" name="category">
                    <div class="form-controls">
                        <input type="text" id="fid" name="Id" placeholder="ID CATEGORY" onchange="existedCategory();">
                    </div>
                    <span id="error_id" class="category-error"></span>

                    <div class="form-controls">
                        <input type="text" id="fname" name="Name" placeholder="NAME CATEGORY">
                    </div>
                    <span id="error_name" class="category-error"></span>

                    <!-- <span class="category-susscess"><?php echo $alert_success; ?></span> -->
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="padding:1.375rem 1.75rem; font-size: 1.2rem;">RETURN</button>
                <button type="submit" class="btn btn-primary" style="padding:1.375rem 1.75rem;  font-size: 1.2rem;">ACCEPT</button>
            </div>
            </form>
        </div>
    </div>
</div>