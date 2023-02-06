<script>
    function checkAll(checkbox, columnNumber) {
        var table = document.getElementById("users_table");
        var checkboxes = table.getElementsByClassName(columnNumber + "-column");
        for(var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = checkbox.checked;
        }
    }

    function updateTopCheckbox() {
        var topCheckbox = document.getElementById("topCheckbox");
        var table = document.getElementById("users_table");
        var checkboxes = table.getElementsByClassName("first-column");
        var allChecked = true;
        for (var i = 0; i < checkboxes.length; i++) {
            if (!checkboxes[i].checked) {
                allChecked = false;
                break;
            }
        }
        topCheckbox.checked = allChecked;
    }

    $(document).ready(function() {
        var table = $('#users_table').DataTable({
            "bPaginate": false,
            "info": false,
            "ordering": false,
        });
        table.buttons( '.export' ).remove();
    } );
</script>
