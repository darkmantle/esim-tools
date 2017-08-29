<template>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Employee Table</h3>
                    </div>
                    <div class="panel-body">
                        <div id="table" class="table-editable">
                            <h5>Click on cells to edit them</h5>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Skill</th>
                                    <th>Salary</th>
                                    <th>Production</th>
                                    <th>Items created</th>
                                    <th>Cost per item</th>
                                    <th class="text-center"><span class="table-add glyphicon glyphicon-plus" v-on:click="tableAdd"></span></th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- This is our clonable table line -->
                                <tr class="hide">
                                    <td contenteditable="true" class="focuser">...</td>
                                    <td contenteditable="true" class="focuser skill">1</td>
                                    <td contenteditable="true" class="focuser salary">0</td>
                                    <td class="production">0</td>
                                    <td class="objects">0</td>
                                    <td class="itemcost">0</td>
                                    <td class="text-center">
                                        <span class="table-remove glyphicon glyphicon-remove" onclick="tableRemove()"></span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
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
                                    <option value="6">Weapon</option>
                                    <option value="7">Food</option>
                                    <option value="8">Gift</option>
                                    <option value="9">House</option>
                                    <option value="10">Ticket</option>
                                    <option value="11">Defense System</option>
                                    <option value="12">Hospital</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quality">Company Quality</label>
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
                                    <input type="checkbox" onchange="calculate()" id="hasCapital">
                                    Country owns it's capital
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" onchange="calculate()" id="highRawCountry">
                                    Country controls high raw region
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" onchange="calculate()" id="highRawRegion">
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
                            <input type="number" class="form-control focuser" id="rawPrice" value="0" step="0.1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                table: {}
            }
        },
        mounted() {
          this.table = $('#table');
        },
        methods: {
            fetch: function (country, skill) {
            },
            changeCurrency: function (event) {
                this.country = event.target.value;
            },
            changeSkill: function (event) {
                this.skill = event.target.value;
            },
            tableAdd: function() {
                let $clone = this.table.find('tr.hide').clone(true).removeClass('hide table-line');
                this.table.find('table').append($clone);
                calculate();
            }
        }
    }
</script>
