@extends('layouts.app2')

@section('content')
    <div id="roles_display"></div>
@endsection

@section('datatable_section')
        <script type="text/javascript">
            fetchData();
            function setUserRole(value, key){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url : "{{route('change_roles')}}",
                    type : "POST",
                    data : {
                                rid : key,
                                status : value,
                                _token : CSRF_TOKEN
                    },
                    success : function(response){
                        fetchData();
                    }
                });
            }

            function fetchData(){
                $.ajax({
                    url : "{{route('populate_roles')}}",
                    type : "GET",
                    success : function(response){
                        $("#roles_display").html(response);
                    }
                });
            }
        </script>
@endsection

@section('model_errors')
        <?php
            if(0 == 1){
                $call_model_sms("Do Locked","Do locked by $locker","success");
            }
        ?>
@endsection