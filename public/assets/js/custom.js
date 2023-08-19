function deleteRow(url, token, tableId) {
    swal({
        title: "Are you sure?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    '_token': token,
                },
                success: function (response) {
                    if (response.status === true) {
                        swal({
                            text: response.message,
                            icon: "success",
                        });
                        $('#' + tableId).DataTable().draw();
                    } else {
                        swal({
                            text: response.message,
                            icon: "warning",
                        });
                    }
                },
            });
        }
    });
}

