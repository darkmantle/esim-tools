@extends('layouts.app')

@section('content')
    <company></company>
@endsection

@section('javascript')
    <script>
        function tableRemove() {
            $('.table-remove').click(function () {
                $(this).parents('tr').detach();
            });
        }

        function calculate() {
            console.log("Gay");
        }

        $(document).ready(function () {
            $(".focuser").focusout(function () {
                calculate();
            });

            $("#type, #quality").change(function () {
                calculate();
            })
        });
    </script>
@endsection