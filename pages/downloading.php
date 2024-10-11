
<script>
var i = 0;
var txt = 'You are downloading Details in Excel fomat.';
var speed = 50;

function typeWriter() {
  if (i < txt.length) {
    document.getElementById("demo").innerHTML += txt.charAt(i);
    i++;
    setTimeout(typeWriter, speed);
  }
}
</script>
<script type="text/javascript">
    function mess(){
        return true;

    }
</script>