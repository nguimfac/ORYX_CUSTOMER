<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Example 2</title>
    <link rel="stylesheet" href="style.css" media="all" />
</head>

<body>
    <header class="clearfix">
        <div id="logo" style="float:left;display:flex;flex-wrap: wrap">
            <span><img src="{{public_path('images/oryx.png')}}"></span>
            <center><img src="{{public_path ('images/optimusclient.jpg')}}" width="75"></center>
            <span style="float:right;margin-right:100px"><img src="{{public_path ('images/text.png')}}" width="200"></span>
        </div>

    </header>
    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <div class="to">INVOICE TO:</div>
                <h4 class="name">CLient:{{$client_name}}</h4>
                <div class="address">{{$client_address}}, {{$client_ville}}</div>
                <div class="email"><a href="mailto:john@example.com">Email:{{$client_email}}</a></div>
                <div class="date">Date : {{$invoice_date}}</div>
            </div>
        </div>
        <table border="0" cellspacing="5" cellpadding="0">
            <thead>
                <tr>
                    <th class="no">N°</th>
                    <th class="desc">DESCRIPTION</th>
                    <th class="unit">UNIT PRICE</th>
                    <th class="total">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="no">01</td>
                    <td class="desc">
                        <h3>Logiciel</h3>{{$logiciel}}
                    </td>
                    <td class="unit">{{$paye}}</td>
                    <td class="total">{{$paye}}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">SUBTOTAL</td>
                    <td>{{$paye}}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">TAX 19.5%</td>
                    <td>$1,300.00</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">GRAND TOTAL</td>
                    <td>{{$paye}}</td>
                </tr>
            </tfoot>
        </table>
        <div id="thanks">Oryx Consulting</div>
        <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
        </div>
    </main>
    <footer>
        Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</body>



<style>
    @font-face {
        font-family: SourceSansPro;
        src: url(SourceSansPro-Regular.ttf);
    }
    
    .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }
    
    a {
        color: #0087C3;
        text-decoration: none;
    }
    
    body {
        position: relative;
        width: 21cm;
        height: 29.7cm;
        margin: 0 auto;
        color: #555555;
        background: #FFFFFF;
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-family: SourceSansPro;
    }
    
    header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #AAAAAA;
    }
    
    #logo {
        float: left;
        margin-top: 8px;
    }
    
    #logo img {
        height: 70px;
    }
    
    #company {
        float: right;
        text-align: right;
    }
    
    #details {
        margin-bottom: 50px;
    }
    
    #client {
        padding-left: 6px;
        border-left: 6px solid #0087C3;
        float: left;
    }
    
    h2.name {
        font-size: 1.4em;
        font-weight: normal;
        margin: 0;
    }
    
    #invoice {
        float: right;
        text-align: right;
    }
    
    #invoice h1 {
        color: #0087C3;
        font-size: 2.4em;
        line-height: 1em;
        font-weight: normal;
        margin: 0 0 10px 0;
    }
    
    #invoice .date {
        font-size: 1.1em;
        color: #777777;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-top: -20px;
    }
    
    table th,
    table td {
        padding: 20px;
        background: #EEEEEE;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
    }
    
    table th {
        white-space: nowrap;
        font-weight: normal;
    }
    
    table td {
        text-align: right;
    }
    
    table td h3 {
        color: #57B223;
        font-size: 1.2em;
        font-weight: normal;
        margin: 0 0 0.2em 0;
    }
    
    table .no {
        color: #FFFFFF;
        font-size: 1.6em;
        background: #561a7e;
    }
    
    table .desc {
        text-align: left;
    }
    
    table .unit {
        background: #DDDDDD;
    }
    
    table .qty {}
    
    table .total {
        background: #561a7e;
        color: #FFFFFF;
    }
    
    table td.unit,
    table td.qty,
    table td.total {
        font-size: 1.2em;
    }
    
    table tbody tr:last-child td {
        border: none;
    }
    
    tfoot {
        margin-left: 50px;
    }
    
    table tfoot td {
        padding: 10px 20px;
        background: #FFFFFF;
        border-bottom: none;
        font-size: 1.2em;
        white-space: nowrap;
        border-top: 1px solid #AAAAAA;
    }
    
    table tfoot tr:first-child td {
        border-top: none;
    }
    
    table tfoot tr:last-child td {
        color: #561a7e;
        font-size: 1.4em;
        border-top: 1px solid #561a7e;
    }
    
    table tfoot tr td:first-child {
        border: none;
    }
    
    #thanks {
        font-size: 2em;
        margin-bottom: 50px;
    }
    
    #notices {
        padding-left: 6px;
        border-left: 6px solid #0087C3;
    }
    
    #notices .notice {
        font-size: 1.2em;
    }
    
    footer {
        color: #777777;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #AAAAAA;
        padding: 8px 0;
        text-align: center;
    }
</style>

</html>