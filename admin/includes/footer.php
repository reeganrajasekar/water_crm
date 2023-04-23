<script src="/admin/js/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/admin/js/app-style-switcher.js"></script>
<script src="/admin/js/waves.js"></script>
<script src="/admin/js/sidebarmenu.js"></script>
<script src="/admin/js/custom.js"></script>
<script>
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  if (urlParams.get('err')) {
    document.write("<div id='err' style='position:fixed;bottom:30px; right:30px;background-color:#FF0000;padding:10px;border-radius:10px;box-shadow:2px 2px 4px #aaa;color:white;font-weight:600'>" + urlParams.get('err') + "</div>")
    setTimeout(() => {
      document.getElementById("err").style.display = "none"
    }, 3000)
  }
</script>
<script>
  if (urlParams.get('msg')) {
    document.write("<div id='msg' style='position:fixed;bottom:30px; right:30px;background-color:#4CAF50;padding:10px;border-radius:10px;box-shadow:2px 2px 4px #aaa;color:white;font-weight:600'>" + urlParams.get('msg') + "</div>")
    setTimeout(() => {
      document.getElementById("msg").style.display = "none"
    }, 3000)
  }
</script>