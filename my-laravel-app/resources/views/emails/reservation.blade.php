<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Service-Bank</title>
    <style>
        .body-service {
            width: 100%;
            margin: auto;
            background: linear-gradient(to top,#fffcea,#a5f2e7,#8983f3 );
            font-family: Arial sans-serif;
        }
        .flexcontainer2 {
            display: flex;
            margin: 5% 20% 20% 20%;

        }

        .flexchild2 {
            flex: 1;
            border: 5px solid ;
            border-image:   linear-gradient(to right,violet,yellow) 5;

            padding-top: 10%;
            padding-bottom: 10%;

        }
        .box{
            text-align: center;
        }
    </style>
</head>
<body class="body-service">
<div class="box">
    <svg fill="#000000" height="152px" width="152px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 333.777 333.777" ><g id="SVGRepo_bgCarrier" ></g><g id="SVGRepo_tracerCarrier" ></g><g id="SVGRepo_iconCarrier"> <path d="M313.211,277.262h-7.249v-8.579h-7.238V161.788c1.809,0.802,3.808,1.253,5.915,1.253c8.082,0,14.636-6.553,14.636-14.636 c0-3.292-1.1-6.319-2.935-8.762h2.772l9.858-30.717L176.746,0h-19.716L4.806,108.926l9.858,30.717h2.772 c-1.835,2.442-2.935,5.469-2.935,8.762c0,8.083,6.554,14.636,14.636,14.636c2.107,0,4.106-0.45,5.915-1.253v106.895h-7.238v8.579 h-7.249v12.218h-8.841v44.297h310.328V289.48h-8.841V277.262z M254.033,163.041c2.107,0,4.106-0.45,5.915-1.253v106.895h-7.238 v8.579h-7.249v12.218h-44.697v-12.218h-7.249v-8.579h-7.238V161.788c1.808,0.802,3.808,1.253,5.915,1.253 c8.083,0,14.636-6.553,14.636-14.636c0-3.292-1.1-6.319-2.935-8.762h38.439c-1.836,2.442-2.936,5.469-2.936,8.762 C239.396,156.488,245.949,163.041,254.033,163.041z M166.888,59.559c10.376,0,18.817,8.441,18.817,18.817 c0,10.375-8.441,18.816-18.817,18.816c-10.376,0-18.817-8.441-18.817-18.816C148.071,68.001,156.512,59.559,166.888,59.559z M204.482,105.762c5.618-7.69,8.944-17.155,8.944-27.386c0-3.967-0.502-7.819-1.44-11.499l54.341,38.884H204.482z M121.791,66.878 c-0.938,3.679-1.44,7.531-1.44,11.499c0,10.231,3.327,19.696,8.944,27.386H67.45L121.791,66.878z M81.067,277.262v-8.579h-7.238 V161.788c1.808,0.802,3.808,1.253,5.915,1.253c8.084,0,14.637-6.553,14.637-14.636c0-3.292-1.1-6.319-2.936-8.762h38.439 c-1.835,2.442-2.935,5.469-2.935,8.762c0,8.083,6.553,14.636,14.636,14.636c2.107,0,4.107-0.45,5.915-1.253v106.895h-7.238v8.579 h-7.249v12.218H88.316v-12.218H81.067z"></path> </g></svg>

    <h1>Central Bank</h1>
    <div class="flexcontainer2">
        <div class="flexchild2">
            <h2>Notification</h2>
            <p>cher client , il vous reste moin de 10 min pour votre rendez vous</p>

        </div>

    </div>
</div>
</body>
</html>
