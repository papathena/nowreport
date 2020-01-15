<!--delete session-->
{{session()->flush()}}
Your're logout!, redirect to login page...
<script>
    setTimeout(function(){
        window.location = "{{route('glogin')}}";
    },2000);
</script>