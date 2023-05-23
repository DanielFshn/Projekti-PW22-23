
$(document).ready(function () {
    $(".delete_product_btn").click(function (e) {
        e.preventDefault();
        var id = $(this).val();

        swal({
            title: "Are you sure to delete this product?",
            text: "Once deleted, you will not be able to recover!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    method: "GET",
                    url: "delete.php",
                    data: {
                        Id: id,
                        delete_product_btn: true,
                    },
                    success: function (response) {
                        console.log(response);
                        if (response == 200) {
                            swal("Success!", "Product deleted Successfully", "success");
                            $("#productsTable").load(location.href + " #productsTable");
                        }
                    },
                });
            } else {
                swal("Your product is safe!");
            }
        });
    });
});
