<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#tugas , #kelas').select2();
    });
</script>
<script>
    $(document).ready(function() {
        const master = document.querySelector('#master');
        master.onclick = checkAll1;
    });

    function check(checked = true) {
        const ceker = document.querySelectorAll('#ceker');
        ceker.forEach((ck) => {
            ck.checked = checked;
        });
    }

    function checkAll1() {
        check();
        this.onclick = uncheckAll1;
    }

    function uncheckAll1() {
        check(false);
        this.onclick = checkAll1;
    }
</script>


</body>

</html>