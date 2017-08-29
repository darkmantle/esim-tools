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
            var type = $('#type').val();
            var quality = $('#quality').val();
            var hasCapital = $('#hasCapital').is(":checked");
            var highRawCountry = $('#highRawCountry').is(":checked");
            var highRawRegion = $('#highRawRegion').is(":checked");
            var rawPrice = $('#rawPrice').val();

            console.log(type);
            console.log(quality);
            console.log(hasCapital);
            console.log(highRawCountry);
            console.log(highRawRegion);
            console.log(rawPrice);
        }

        $(document).ready(function () {
            $(".focuser").focusout(function () {
                calculate();
            });

            $(".focuser").on('input', function(e) {
               calculate();
            });

            $("#type, #quality").change(function () {
                calculate();
            })
        });
    </script>
@endsection