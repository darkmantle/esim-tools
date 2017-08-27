<template>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Employee Table</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Skill</th>
                                <th>Salary</th>
                                <th>Production</th>
                                <th>Items created</th>
                                <th>Cost per item</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Darkmantle</td>
                                <td>6.00</td>
                                <td>105.45</td>
                                <td>1000.12</td>
                                <td>123.12</td>
                                <td>0.23512</td>
                            </tr>
                            <tr>
                                <td>Darkmantle</td>
                                <td>6.00</td>
                                <td>105.45</td>
                                <td>1000.12</td>
                                <td>123.12</td>
                                <td>0.23512</td>
                            </tr>
                            <tr>
                                <td>Darkmantle</td>
                                <td>6.00</td>
                                <td>105.45</td>
                                <td>1000.12</td>
                                <td>123.12</td>
                                <td>0.23512</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Company Information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="type">Company Type</label>
                            <select id="type" name="formProductionObject" class="validate[required] form-control">
                                <optgroup label="Raw Materials" id="typeRaw">
                                    <option value="0">Iron</option>
                                    <option value="1">Grain</option>
                                    <option value="2">Oil</option>
                                    <option value="3">Stone</option>
                                    <option value="4">Wood</option>
                                    <option value="5">Diamonds</option>
                                </optgroup>
                                <optgroup label="Products" id="typeProduct">
                                    <option value="0">Weapon</option>
                                    <option value="1">Food</option>
                                    <option value="2">Gift</option>
                                    <option value="3">House</option>
                                    <option value="4">Ticket</option>
                                    <option value="5">Defense System</option>
                                    <option value="6">Hospital</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type">Company Quality</label>
                            <select id="quality" class="validate[required] form-control">
                                <option value="1">Q1</option>
                                <option value="2">Q2</option>
                                <option value="3">Q3</option>
                                <option value="4">Q4</option>
                                <option value="5">Q5</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Country Information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group col-xs-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="">
                                    Country owns it's capital
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="">
                                    Country controls high raw region
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="">
                                    Region contains high raw
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Pricing Information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group col-xs-12">
                            <label for="rawPrice">Price of Raw Material</label>
                            <input type="number" class="form-control" id="rawPrice">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            fetch: function (country, skill) {
            },
            changeCurrency: function (event) {
                this.country = event.target.value;
            },
            changeSkill: function (event) {
                this.skill = event.target.value;
            },
        }
    }
</script>
