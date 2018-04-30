<template>
    <div class="container company-page">
        <div class="row">
            <div class="col-xs-7">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Name your Company">
                </div>
            </div>
            <div class="col-xs-1">
                <button type="submit" class="btn btn-info" v-on:click="calculate">Save</button>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Employee Table</h3>
                    </div>
                    <div class="panel-body">
                        <div id="table" class="table-editable">
                            <h5>Click on cells to edit them</h5>
                            <table class="table table-bordered" ref="mainTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Skill</th>
                                    <th>Salary</th>
                                    <th>Production</th>
                                    <th>Items created</th>
                                    <th>Cost per item</th>
                                    <th class="text-center"><span class="table-add glyphicon glyphicon-plus"
                                                                  v-on:click="tableAdd"></span></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div contenteditable="true">...</div>
                                    </td>
                                    <td>
                                        <input v-on:change="changeSkill" type="number" value="1" />
                                    </td>
                                    <td>
                                        <input v-on:change="changeSalary" type="number" value="1"/>
                                    </td>
                                    <td class="production">0</td>
                                    <td class="objects">0</td>
                                    <td class="itemcost">0</td>
                                    <td class="text-center">
                                        <span class="table-remove glyphicon glyphicon-remove"
                                              onclick="tableRemove()"></span>
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
                            <select id="type" name="formProductionObject" class="validate[required] form-control"
                                    ref="type" v-on:change="updateType">
                                <optgroup label="Raw Materials" id="typeRaw" ref="typeRaw">
                                    <option value="0">Iron</option>
                                    <option value="1">Grain</option>
                                    <option value="2">Oil</option>
                                    <option value="3">Stone</option>
                                    <option value="4">Wood</option>
                                    <option value="5">Diamonds</option>
                                </optgroup>
                                <optgroup label="Products" id="typeProduct" ref="typeProduct">
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
                            <select id="quality" class="validate[required] form-control" ref="quality">
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
                    <div class="panel-body country-panel">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" v-on:change="calculate" id="hasCapital" ref="hasCapital">
                                    Country owns it's capital
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" v-on:change="calculate" id="highRawCountry"
                                           ref="highRawCountry">
                                    Country controls high raw region
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" v-on:change="calculate" id="highRawRegion"
                                           ref="highRawRegion">
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
                        <div class="form-group">
                            <label for="rawPrice">Price of Raw Material</label>
                            <input type="number" class="form-control focuser" id="rawPrice" value="0" step="0.1"
                                   ref="rawPrice">
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
                table: {},
                type: 0,
                quality: 0,
                selects: {
                    rawPrice: 100
                }
            }
        },
        mounted() {
            this.table = $('#table');
            const vue = this;
            $('.table-remove').click(function () {
                if ($('#table').find('tr').length === 2) return;
                $(this).parents('tr').detach();
                vue.calculate();
            });
            this.calculate();
        },
        methods: {
            fetch: function (country, skill) {
            },
            changeCurrency: function (event) {
                this.country = event.target.value;
            },
            changeSkill: function () {
                this.calculate();
            },
            changeSalary: function() {
                this.calculate();
            },
            tableAdd: function () {
                const size = this.table.find('tr').length;
                const clone = this.table.find('tr').clone(true);
                this.table.find('table').append(clone[size - 1]);
                this.calculate();
            },
            updateType: function (e) {
                this.type = e.target.value;
                this.calculate();
            },
            updateQuality: function(e) {
                this.quality = e.target.value;
                this.calculate();
            },
            getCompanyInfo: function () {
                const type = this.$refs.type[this.type].value * 1;
                const quality = this.$refs.quality[this.quality].value * 1;
                const hasCapital = this.$refs.hasCapital.checked;
                const highRawCountry = this.$refs.highRawCountry.checked;
                const highRawRegion = this.$refs.highRawRegion.checked;
                const rawPrice = this.$refs.rawPrice.value*1;

                return {type, quality, hasCapital, highRawCountry, highRawRegion, rawPrice};
            },
            calculate: function() {
                const {type, quality, hasCapital, highRawCountry, highRawRegion, rawPrice} = this.getCompanyInfo();

                let E = 1;
                let N = 1;
                let C = 1;
                let R = 1;
                let M = 1;

                if (!hasCapital) C = 0.75;

                if (type > 5 && highRawCountry) {
                    R = 1.25
                }

                if (type < 5) {
                    R = 3 * ((quality / 20) + 0.2);
                    if (highRawRegion) R = 4 * ((quality / 20) + 0.2);
                }

                let employeesWorked = 0;

                const table = this.$refs.mainTable;

                for (let i=1, row; row=table.rows[i]; i++) {
                    const cells = row.cells;
                    const skill = cells[1].childNodes[0].value;

                    if (employeesWorked <= 10) {
                        N = 15 - (employeesWorked / 2);
                    } else if (employeesWorked <= 20) {
                        N = 13 - ((3*employeesWorked)/10);
                    } else if (employeesWorked < 30) {
                        N = 11 - (employeesWorked/5);
                    } else {
                        N = 5;
                    }

                    let prod = (4 + skill * 1) * N * C * R * M;
                    prod = prod.toFixed(2);

                    let items, cost;
                    const salary = cells[2].childNodes[0].value*1;

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
                        let rawCost = ((prod * rawPrice) / items).toFixed(3);
                        cost = cost*1 + rawCost*1;
                    }

                    cells[3].innerText = prod;
                    cells[4].innerText = items;
                    cells[5].innerText = cost;

                    employeesWorked++;
                }
            }
        }
    }
</script>
