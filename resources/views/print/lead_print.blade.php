<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lead Information</title>
    @include('print.print_asset')
    <style>
        .table>tbody>tr>td {
            padding: 5px !important;
        }
        @media print {
            .table>tbody>tr>td {
                padding: 5px !important;
                font-size: 12px;
            }
            .table>thead>tr>th {
                padding: 10px 5px  !important;
                font-size: 13px;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
</head>
<body>
<div class="content" >
    <div class="panel">

        <div class="panel-body no-padding-bottom">
            <div class="row">
                <div class="col-sm-10 col-md-6 content-group" style="float:left; width: 10%">
                    <img src="/logo.jpg" alt="logo" style="max-width:100px; max-height: 80px;">
                </div>
                <div class="col-sm-10 col-md-6 content-group" style="float:left; width: 80%">
                    <ul class="list-condensed list-unstyled">
                        <li style="margin: 0;"><h5 class="text-uppercase text-semibold" style="margin: 0;">{{ config('app.name') }}</h5></li>
                        <li style="margin: 0;">Address: {{ (!empty($contactUs) && !empty($contactUs->data)) ? $contactUs->data['address'] : '' }}</li>
                        <li style="margin: 0;">Email: {{ (!empty($contactUs) && !empty($contactUs->data)) ? $contactUs->data['email'] : '' }}</li>
                        <li style="margin: 0;">Phone: {{ (!empty($contactUs) && !empty($contactUs->data)) ? $contactUs->data['phone_no'] : '' }} <br>
                            Fax #: {{ (!empty($contactUs) && !empty($contactUs->data)) ? $contactUs->data['fax_no'] : '' }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row invoice-payment">
                <div class="col-sm-6 " style="float: left; width: 50%;">
                    <div class="content-group">
                        <h6>User Documentation</h6>
                        <div class="table-responsive ">
                            <table class="table table-sm table-striped table-bordered">
                                <tbody>
                                    <tr>
                                        <th>First Name: </th>
                                        <td class="text-left" style="min-width: 5rem">{{ $lead->first_name }} </td>
                                    </tr>
                                    <tr>
                                        <th>Last Name: </th>
                                        <td class="text-left" style="min-width: 5rem">{{ $lead->last_name }} </td>
                                    </tr>
                                    <tr>
                                        <th>Email: </th>
                                        <td class="text-left" style="min-width: 5rem">{{ $lead->email }} </td>
                                    </tr>
                                    <tr>
                                        <th>Phone No.: </th>
                                        <td class="text-left" style="min-width: 5rem">{{ $lead->phone_no }} </td>
                                    </tr>
                                    <tr>
                                        <th>Address: </th>
                                        <td class="text-left" style="min-width: 5rem">{{ $lead->full_address }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 " style="float: right; width: 50%;">
                    <div class="content-group">
                        <h6>Vehicle information</h6>
                        <div class="table-responsive ">
                            <table class="table table-sm table-striped table-bordered">
                                <tbody>
                                <tr>
                                    <th>VIN No.: </th>
                                    <td class="text-left" style="min-width: 5rem">{{ $lead->vin_no }} </td>
                                </tr>
                                <tr>
                                    <th>Year: </th>
                                    <td class="text-left" style="min-width: 5rem">{{ $lead->year }} </td>
                                </tr>
                                <tr>
                                    <th>Make: </th>
                                    <td class="text-left" style="min-width: 5rem">{{ $lead->make }} </td>
                                </tr>
                                <tr>
                                    <th>Model.: </th>
                                    <td class="text-left" style="min-width: 5rem">{{ $lead->model }} </td>
                                </tr>
                                <tr>
                                    <th>Color: </th>
                                    <td class="text-left" style="min-width: 5rem">{{ $lead->color }} </td>
                                </tr>
                                <tr>
                                    <th>Mileage: </th>
                                    <td class="text-left" style="min-width: 5rem">{{ $lead->mileage }} </td>
                                </tr>
                                <tr>
                                    <th>Lein Holder Info: </th>
                                    <td class="text-left" style="min-width: 5rem">{{ $lead->lein_holder_info }} </td>
                                </tr>
                                <tr>
                                    <th>Payment Type: </th>
                                    <td class="text-left" style="min-width: 5rem">{{ $lead->payment_type }} </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('load', (event) => {
        console.log('page is fully loaded');
        window.print();
    });

    window.addEventListener("afterprint", function(event) {
        console.log('print cancel');
        window.close();
        window.location = "{!! route('admin.lead.show', $lead->lead_id) !!}";
    });
</script>
</body>
</html>
