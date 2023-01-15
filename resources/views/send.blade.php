<html>
<head>
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
    <button onclick="loadMe('my string')">clock me</button>

    <input type="text" onkeyup="loadMe(this.value)">
    <div id="display"></div>
</body>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function loadMe(str){
        var form_data = new FormData();
        form_data.append('str',str);
        //token
        form_data.append('_token',$('#csrf-token').val());
        $.ajax({
            url:'{{route('loadText')}}',
            dataType:'text',
            cache:false,
            processData:false,
            contentType:false,
            data:form_data,
            type:'post',
            success:function (response){
                $('#display').html(response);
            },
            error: function (xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }

        })
    }



</script>
</html>
