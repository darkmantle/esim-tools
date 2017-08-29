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
            const type = $('#type').val() * 1;
            const quality = $('#quality').val() *1;
            const hasCapital = $('#hasCapital').is(":checked");
            const highRawCountry = $('#highRawCountry').is(":checked");
            const highRawRegion = $('#highRawRegion').is(":checked");
            const rawPrice = $('#rawPrice').val();

            var E = 1;
            var N = 1;
            var C = 1;
            var R = 1;
            var M = 1;

            if (!hasCapital) C = 0.75;

            if (type > 5 && highRawCountry) {
                R = 1.25
            }

            if (type < 5) {
                R = 3 * ((quality / 20) + 0.2);
                if (highRawRegion) R = 4 * ((quality / 20) + 0.2);
            }

            let employeesWorked = 0;

            $('.table > tbody > tr').each(function () {
                if ($(this).hasClass('hide')) return;
                var skill = $(this).find('.skill').html();


                if (employeesWorked <= 10) {
                    N = 15 - (employeesWorked / 2);
                } else if (employeesWorked <= 20) {
                    N = 13 - ((3*employeesWorked)/10);
                } else if (employeesWorked < 30) {
                    N = 11 - (employeesWorked/5);
                } else {
                    N = 5;
                }

                var prod = (4 + skill * 1) * N * C * R * M;
                prod = prod.toFixed(2);

                var items, cost;
                const salary = $(this).find('.salary').html();

                if (type <= 5 || type === 7) {
                    items = prod;
                }

                switch(type) {
                    case 6 || 8:
                        items = prod/2;
                        break;
                    case 7:
                        items = prod;
                        break;
                    case 9 || 11 || 12:
                        items = prod/300;
                        break;
                    case 10:
                        items = prod/5;
                        break;
                    default:
                        break;

                }

                if (type > 5) {
                    items = items/quality;
                }

                cost = (salary/items).toFixed(3);

                if (type > 5) {
                    var rawCost = ((prod * rawPrice) / items).toFixed(3);
                    cost = cost*1 + rawCost*1;
                }

                $(this).find('.production').html(prod);
                $(this).find('.objects').html(items);
                $(this).find('.itemcost').html(cost);

                employeesWorked++;
            })

        }

        $(document).ready(function () {
            $(".focuser").focusout(function () {
                calculate();
            });

            $(".focuser").on('input', function (e) {
                calculate();
            });

            $("#type, #quality").change(function () {
                calculate();
            })
        });
    </script>
@endsection