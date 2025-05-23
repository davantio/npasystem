<!DOCTYPE html>
<html lang="en">

<head>
    <link href="print_style.css" rel="stylesheet">
    <meta charset="utf-8">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="{{asset('AdminLTE/dist')}}/css/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>@page {
        size: A5 landscape;
        margin-top: 8px;
        margin-bottom: 10px;
        margin-left: 20px;
    }</style>
    <style>
        /* Three image containers (use 25% for four, and 50% for two, etc) */
        .column {
            float: left;
            padding: 5px;
        }

        /* Clear floats after image containers */
        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        table tbody tr td {
            padding: 2px !important;
            line-height: 1.35 !important;
        }

        @media print {
            .box-body {
                margin-top: 10px !important;
                margin-bottom: 10px;
            }
        }
    </style>

    <script>
        /*window.onload = function () {
          window.print();
           window.top.close();

        }*/
    </script>
    <style>
        .center-me {
            font-size: 15px;
            margin: auto;
            height: 10px;
            max-width: 500px;
            margin: 75px auto 40px auto;
            display: flex;
        }
    </style>
</head>
<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A5 landscape">

<!-- Each sheet element should have the class "sheet" -->
<!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
<section class="sheet" id="content-print">
    <style>
        table {
            /*border-collapse: unset !important;*/
        }
    </style>

    <div class="box-body" id="box_data" style="display: flex;padding: 5px 10px 0 10px;margin-bottom: -21px;">
        <div style="width: 100%;padding-right: 10px;" class="col-md-12">
            <div class="row">
                <div class="col-lg-4" style="width: 70%;padding-left: 20px;">
                    <h4>INVOICE</h4>
                </div>
                <div class="col-lg-8" style="width: 30%;">
                    <h5 style="font-size: 20px;margin-bottom: 15px;margin-top: 45px;">Your Company Name</h5>

                    <p style="font-size: 12px;margin: 0;padding: 0;">Street Address</p>

                    <p style="font-size: 12px;margin: 0;padding-top: 3px;;">City,State,Zip</p>

                    <p style="font-size: 12px;margin: 0;padding-top: 5px;;">Phone: (000) 000-0000</p>
                    <br>
                </div>
            </div>
            <div class="" style="display: flex;margin-top: -62px;">
            <table border="1" style="width:30%">
                <tr class="" style="background: rgba(217,225,242,1.0)">
                    <td style="font-size: 14px;"  class="db text-center" width="100px">
                        Date & TIme
                    </td>
                    <td style="border-left: none;font-size: 14px;">
                        INVOICE NO
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 12px;">14/09/2019 20:52</td>
                    <td>1</td>
                </tr>
            </table>
            </div>
            <br>

            <table width="100%" border="1">
                <tr style="background: rgba(217,225,242,1.0)">
                    <th class="text-center" colspan="2" style="width: 25%;">Bill To</th>
                </tr>
                <tr>
                    <th style="width: 5%;font-size: 12px;background: rgba(217,225,242,1.0)">Consumer Name</th>
                    <th></th>
                </tr>
                <tr>
                    <th style="width: 5%;font-size: 12px;background: rgba(217,225,242,1.0)">Company Name</th>
                    <th></th>
                </tr>
                <tr>
                    <th style="width: 5%;font-size: 12px;background: rgba(217,225,242,1.0)">Street Address</th>
                    <th></th>
                </tr>
                <tr>
                    <th style="width: 5%;font-size: 12px;background: rgba(217,225,242,1.0)">City State ZIp</th>
                    <th></th>
                </tr>
                <tr>
                    <th style="width: 5%;font-size: 12px;background: rgba(217,225,242,1.0)">Phone</th>
                    <th></th>
                </tr>
                <tr>
                    <th style="width: 5%;font-size: 12px;background: rgba(217,225,242,1.0)">Email Address</th>
                    <th></th>
                </tr>
            </table>
            <br>
            <table width="100%" border="1px">
                <tr style="background: rgba(217,225,242,1.0);">
                    <th class="text-center">
                        #
                    </th>
                    <th class="text-center" colspan="3">
                        Product Description
                    </th>
                    <th class="text-center">
                        Price
                    </th>
                    <th class="text-center">
                        Quantity
                    </th>
                    <th class="text-center">
                        Amount
                    </th>
                </tr>
                <tbody>
                <tr><td>1</td><td colspan="3">iPhone xs Plus</td><td>20000</td><td>1</td><td>20000</td></tr>
                <tr><td>1</td><td colspan="3">iPhone xs Plus</td><td>20000</td><td>1</td><td>20000</td></tr>
                <tr><td>1</td><td colspan="3">iPhone xs Plus</td><td>20000</td><td>1</td><td>20000</td></tr>
                <tr><td>1</td><td colspan="3">iPhone xs Plus</td><td>20000</td><td>1</td><td>20000</td></tr>
                <tr><td>1</td><td colspan="3">iPhone xs Plus</td><td>20000</td><td>1</td><td>20000</td></tr>
                <tr><td>1</td><td colspan="3">iPhone xs Plus</td><td>20000</td><td>1</td><td>20000</td></tr>
                <tr><td>1</td><td colspan="3">iPhone xs Plus</td><td>20000</td><td>1</td><td>20000</td></tr>
                <tr><td>1</td><td colspan="3">iPhone xs Plus</td><td>20000</td><td>1</td><td>20000</td></tr>
                <tr><td>1</td><td colspan="3">iPhone xs Plus</td><td>20000</td><td>1</td><td>20000</td></tr>
                </tbody>
                <tfoot>
                <tr style="background: rgba(217,225,242,1.0);">
                    <td>Tax</td>
                    <td>7%</td>
                    <td>Discount</td>
                    <td>5%</td>
                    <td colspan="2">Total Amount</td>
                    <td colspan="1">5741</td>
                </tr>
                <tr style="background: rgba(217,225,242,1.0);">
                    <td colspan="2">401.87</td>
                    <td colspan="2">287.05</td>
                    <td colspan="2">Final Amount</td>
                    <td>5855.82</td>
                </tr>
                </tfoot>
            </table>
            <br>
            <table width="94%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="19%" rowspan="3" valign="top"><strong class="asd"> &nbsp;<br></strong></td>
                    <td width="65%" align="center" valign="top">
                        <h6>If you have any query about this invoice, please contact us at</h6>
                        <h6>Name, Email, Phone</h6></td>
                    <td width="16%" valign="top"><h6 style="margin-bottom: 0;">
                        <span style="text-decoration: dashed; padding-left: 100%;color: #000; border-bottom: 1px solid black;"></span>
                    </h6>
                        <h6 class="text-center"
                        style="margin-top: 5px;">Signature and Seal</h6></td>
                </tr>

            </table>
        </div>

    </div>

</section>
</body>
</html>