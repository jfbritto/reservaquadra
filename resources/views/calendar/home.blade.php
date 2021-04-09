@extends('adminlte::page')

@section('title', 'Calendário')

@section('content_header')
    <h1>Calendário</h1>
@stop

@section('css')
    <style>

        .box-cel{
            min-height: 150px !important;
            /* background-color: grey; */
        }
        .title-cel{
            /* margin-top: -60px !important;
            margin-left: -3px !important; */
            height: 20px !important;
            margin-bottom: 10px !important;
            text-align: right !important;
        }

        .item-cel{
            margin-bottom: 3px;
            cursor: pointer !important;
        }
        .item-cel:hover{
            opacity: 0.8 !important;
        }
        .badge{
            border-radius: 30px !important;
            font-size: 100% !important;
        }
        .class_bloq{
            opacity: 0.2 !important;
        }

    </style>
@stop

@section('content')
    
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title"> </h3>
            <div class="card-tools">
                <!-- <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreCourt">
                <i class="fas fa-plus"></i>
                </a> -->
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-valign-middle table-bordered">
                    <thead>
                        <tr>
                            <th>Dom</th>
                            <th>Seg</th>
                            <th>Ter</th>
                            <th>Qua</th>
                            <th>Qui</th>
                            <th>Sex</th>
                            <th>Sáb</th> 
                        </tr>
                    </thead>
                    <tbody id="list">
                    
                        <tr>
                            <td>
                                <div class="title-cel"><span class="badge badge-dark">04</span></div>
                                <span class="badge badge-success" style="width: 100%;">serwer</span>


                            </td>
                            <td>05</td>
                            <td>06</td>
                            <td>07</td>
                            <td>08</td>
                            <td>09</td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
                            <td>15</td>
                            <td>16</td>
                            <td>17</td>
                        </tr>
                        <tr>
                            <td>18</td>
                            <td>19</td>
                            <td>20</td>
                            <td>21</td>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                        </tr>
                        <tr>
                            <td>25</td>
                            <td>26</td>
                            <td>27</td>
                            <td>28</td>
                            <td>29</td>
                            <td>30</td>
                            <td>31</td>
                        </tr>
                    
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@stop

@section('js')
    <script src="/js/calendar/home.js"></script>
@stop