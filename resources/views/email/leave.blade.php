<!doctype html>
<html>

<head>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <meta name="viewport" content="width=device-width" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Simple Transactional Email</title>
  <style>
    /* -------------------------------------
          GLOBAL RESETS
      ------------------------------------- */

    /*All the styling goes here*/


    img {
      border: none;
      -ms-interpolation-mode: bicubic;
      max-width: 100%;
    }

    body {
      background-color: #f6f6f6;
      font-family: sans-serif;
      -webkit-font-smoothing: antialiased;
      font-size: 14px;
      line-height: 1.4;
      margin: 0;
      padding: 0;
      -ms-text-size-adjust: 100%;
      -webkit-text-size-adjust: 100%;
    }

    table {
      border-collapse: separate;
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
      width: 100%;
    }

    table td {
      font-family: sans-serif;
      font-size: 14px;
      vertical-align: top;
    }

    /* -------------------------------------
          BODY & CONTAINER
      ------------------------------------- */

    .body {
      background-color: #f6f6f6;
      width: 100%;
    }

    /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
    .container {
      display: block;
      margin: 0 auto !important;
      /* makes it centered */
      max-width: 580px;
      padding: 10px;
      width: 580px;
    }

    /* This should also be a block element, so that it will fill 100% of the .container */
    .content {
      box-sizing: border-box;
      display: block;
      margin: 0 auto;
      max-width: 580px;
      padding: 10px;
    }

    /* -------------------------------------
          HEADER, FOOTER, MAIN
      ------------------------------------- */
    .main {
      background: #ffffff;
      border-radius: 3px;
      width: 100%;
    }

    .wrapper {
      box-sizing: border-box;
      padding: 20px;
    }

    .content-block {
      padding-bottom: 10px;
      padding-top: 10px;
    }

    .footer {
      clear: both;
      margin-top: 10px;
      text-align: center;
      width: 100%;
    }

    .footer td,
    .footer p,
    .footer span,
    .footer a {
      color: #999999;
      font-size: 12px;
      text-align: center;
    }

    /* -------------------------------------
          TYPOGRAPHY
      ------------------------------------- */
    h1,
    h2,
    h3,
    h4 {
      color: #000000;
      font-family: sans-serif;
      font-weight: 400;
      line-height: 1.4;
      margin: 0;
      margin-bottom: 30px;
    }

    h1 {
      font-size: 35px;
      font-weight: 300;
      text-align: center;
      text-transform: capitalize;
    }

    p,
    ul,
    ol {
      font-family: sans-serif;
      font-size: 14px;
      font-weight: normal;
      margin: 0;
      margin-bottom: 15px;
    }

    p li,
    ul li,
    ol li {
      list-style-position: inside;
      margin-left: 5px;
    }

    a {
      color: #3498db;
      text-decoration: underline;
    }

    /* -------------------------------------
          BUTTONS
      ------------------------------------- */
    .btn {
      box-sizing: border-box;
      width: 100%;
    }

    .btn>tbody>tr>td {
      padding-bottom: 15px;
    }

    .btn table {
      width: auto;
    }

    .btn table td {
      background-color: #ffffff;
      border-radius: 5px;
      text-align: center;
    }

    .btn a {
      background-color: #ffffff;
      border: solid 1px #3498db;
      border-radius: 5px;
      box-sizing: border-box;
      color: #3498db;
      cursor: pointer;
      display: inline-block;
      font-size: 14px;
      font-weight: bold;
      margin: 0;
      padding: 12px 25px;
      text-decoration: none;
      text-transform: capitalize;
    }

    .btn-primary table td {
      background-color: #3498db;
    }

    .btn-primary a {
      background-color: #3498db;
      border-color: #3498db;
      color: #ffffff;
    }

    /* -------------------------------------
          OTHER STYLES THAT MIGHT BE USEFUL
      ------------------------------------- */
    .last {
      margin-bottom: 0;
    }

    .first {
      margin-top: 0;
    }

    .align-center {
      text-align: center;
    }

    .align-right {
      text-align: right;
    }

    .align-left {
      text-align: left;
    }

    .clear {
      clear: both;
    }

    .mt0 {
      margin-top: 0;
    }

    .mb0 {
      margin-bottom: 0;
    }

    .preheader {
      color: transparent;
      display: none;
      height: 0;
      max-height: 0;
      max-width: 0;
      opacity: 0;
      overflow: hidden;
      mso-hide: all;
      visibility: hidden;
      width: 0;
    }

    .powered-by a {
      text-decoration: none;
    }

    hr {
      border: 0;
      border-bottom: 1px solid #f6f6f6;
      margin: 20px 0;
    }

    /* -------------------------------------
          RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */
    @media only screen and (max-width: 620px) {
      table[class=body] h1 {
        font-size: 28px !important;
        margin-bottom: 10px !important;
      }

      table[class=body] p,
      table[class=body] ul,
      table[class=body] ol,
      table[class=body] td,
      table[class=body] span,
      table[class=body] a {
        font-size: 16px !important;
      }

      table[class=body] .wrapper,
      table[class=body] .article {
        padding: 10px !important;
      }

      table[class=body] .content {
        padding: 0 !important;
      }

      table[class=body] .container {
        padding: 0 !important;
        width: 100% !important;
      }

      table[class=body] .main {
        border-left-width: 0 !important;
        border-radius: 0 !important;
        border-right-width: 0 !important;
      }

      table[class=body] .btn table {
        width: 100% !important;
      }

      table[class=body] .btn a {
        width: 100% !important;
      }

      table[class=body] .img-responsive {
        height: auto !important;
        max-width: 100% !important;
        width: auto !important;
      }
    }

    /* -------------------------------------
          PRESERVE THESE STYLES IN THE HEAD
      ------------------------------------- */
    @media all {
      .ExternalClass {
        width: 100%;
      }

      .ExternalClass,
      .ExternalClass p,
      .ExternalClass span,
      .ExternalClass font,
      .ExternalClass td,
      .ExternalClass div {
        line-height: 100%;
      }

      .apple-link a {
        color: inherit !important;
        font-family: inherit !important;
        font-size: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
        text-decoration: none !important;
      }

      #MessageViewBody a {
        color: inherit;
        text-decoration: none;
        font-size: inherit;
        font-family: inherit;
        font-weight: inherit;
        line-height: inherit;
      }

      .btn-primary table td:hover {
        background-color: #34495e !important;
      }

      .btn-primary a:hover {
        background-color: #34495e !important;
        border-color: #34495e !important;
      }
    }
    .success-btn{
      padding: .25rem .5rem;
      font-size: .875rem;
      line-height: 1.5;
      border-radius: .2rem;
      color: #fff;
      background-color: #1cc88a;
      border-color: #1cc88a;
    }
    .danger-btn{
      padding: .25rem .5rem;
      font-size: .875rem;
      line-height: 1.5;
      border-radius: .2rem;
      color: #fff;
      background-color: #d52a1a;
      border-color: #ca2819;
    }
  </style>
</head>

<body class="">
  <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
      <td>&nbsp;</td>
      <td class="container">
        <div class="content">

          <!-- START CENTERED WHITE CONTAINER -->
          <table role="presentation" class="main">

            <!-- START MAIN CONTENT AREA -->
            <tr>
              <td class="wrapper">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>
                    
                        @if($leaveApply->status == 1)
                        <table border="1" cellpadding="0" cellspacing="0" width="200px">
                        @if($leaveApply->leave_type == 1)
                       
                        <tr>
                          <td width = 50% style="padding:10px"><b>Name of the Employee </b></td>
                          <td style="padding:10px">{{ ucwords(reportingName($leaveApply->user_id)) }}</td>
                        </tr>
                        <tr>
                          <td width = 50% style="padding:10px"><b>Leave Applied Date</b></td>
                          <td style="padding:10px">{{ date(setting('date_format'),strtotime($leaveApply->created_at))}}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Leave Required From</b></td>
                          <td style="padding:10px"> {{ date(setting('date_format'), strtotime($leaveApply->leave_from)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Leave Required To</b></td>
                          <td style="padding:10px"> {{ date(setting('date_format'), strtotime($leaveApply->leave_to)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Reporting To</b></td>
                          <td style="padding:10px"> {{$name}}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Reason For The Leave  </b></td>
                          <td style="padding:10px">{{ ucfirst($leaveApply->reason) }}</td>
                        </tr>
                        <tr>
                          <td width = 50% style="padding:10px"><b>Leave Status</b></td>
                          <td style="padding:10px"><b>{{ $leaveApply->status == 1 ? 'Pending' : ($leaveApply->status == 2 ? 'Approved' : 'Rejected') }}</b>
                        </td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <div align = "center" style="margin-top:2px;margin-bottom:2px;">
                            <button class="success-btn"><a style="text-decoration: none; color:white;"  class="success-btn" href="{{route('leave.show',$leaveApply->id)}}"><i aria-hidden="true" class="fa fa-check"></i>Approve</a></button>
                            <button class="danger-btn"><a style="text-decoration: none; color:white;" class="btn btn-danger btn-sm" href="{{route('leave.show',$leaveApply->id)}}"><i aria-hidden="true" class="fa fa-close"></i>Reject</a></button>
                            </div>
                          </td>
                        </tr>
                        @elseif($leaveApply->leave_type == 4)
                       
                        <tr>
                          <td width = 50% style="padding:10px"><b>Name of the Employee </b></td>
                          <td style="padding:10px">{{ ucwords(reportingName($leaveApply->user_id)) }}</td>
                        </tr>
                        <tr>
                          <td width = 50% style="padding:10px"><b>Half Day Leave Applied Date</b></td>
                          <td style="padding:10px">{{ date(setting('date_format'),strtotime($leaveApply->created_at))}}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Half Day Leave Required Date</b></td>
                          <td style="padding:10px"> {{ date(setting('date_format'), strtotime($leaveApply->leave_from)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Reporting To</b></td>
                          <td style="padding:10px"> {{$name}}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Reason For The Half Day Leave  </b></td>
                          <td style="padding:10px">{{ ucfirst($leaveApply->reason) }}</td>
                        </tr>
                        <tr>
                          <td width = 50% style="padding:10px"><b>Status</b></td>
                          <td style="padding:10px"><b>{{ $leaveApply->status == 1 ? 'Pending' : ($leaveApply->status == 2 ? 'Approved' : 'Rejected') }}</b>
                        </td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <div align = "center" style="margin-top:2px;margin-bottom:2px;">
                            <button class="success-btn"><a style="text-decoration: none; color:white;"  class="success-btn" href="{{route('leave.show',$leaveApply->id)}}"><i aria-hidden="true" class="fa fa-check"></i>Approve</a></button>
                            <button class="danger-btn"><a style="text-decoration: none; color:white;" class="btn btn-danger btn-sm" href="{{route('leave.show',$leaveApply->id)}}"><i aria-hidden="true" class="fa fa-close"></i>Reject</a></button>
                            </div>
                          </td>
                        </tr>
                        
                        @elseif($leaveApply->leave_type == 2)
                        <tr>
                          <td style="padding:10px" width = 50%><b>Name of the Employee  </b></td>
                          <td style="padding:10px">{{ ucwords(reportingName($leaveApply->user_id)) }}</td>
                        </tr>
                        <tr>
                          <td width = 50% style="padding:10px"><b>Permission Applied Date</b></td>
                          <td style="padding:10px">{{ date(setting('date_format'),strtotime($leaveApply->created_at))}}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Permission Required Date</b></td>
                          <td style="padding:10px"> {{ date(setting('date_format'), strtotime($leaveApply->leave_from)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Permission Required From </b></td>
                          <td style="padding:10px"> {{ date(setting('time_format'), strtotime($leaveApply->leave_from)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Permission Required To </b></td>
                          <td style="padding:10px"> {{ date(setting('time_format'), strtotime($leaveApply->leave_to)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Reporting To</b></td>
                          <td style="padding:10px"> {{$name}}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Reason for the Permission  </b></td>
                          <td style="padding:10px">{{ ucfirst($leaveApply->reason) }}</td>
                        </tr>
                        <tr>
                          <td width = 50% style="padding:10px"><b>Permission Status</b></td>
                          <td style="padding:10px"><b>{{ $leaveApply->status == 1 ? 'Pending' : ($leaveApply->status == 2 ? 'Approved' : 'Rejected') }}</b></td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <div align = "center" style="margin-top:2px;margin-bottom:2px;">
                            <button class="success-btn"><a style="text-decoration: none; color:white;"  class="success-btn" href="{{route('leave.show',$leaveApply->id)}}"><i aria-hidden="true" class="fa fa-check"></i>Approve</a></button>
                            <button class="danger-btn"><a style="text-decoration: none; color:white;" class="btn btn-danger btn-sm" href="{{route('leave.show',$leaveApply->id)}}"><i aria-hidden="true" class="fa fa-close"></i>Reject</a></button>
                            </div>
                          </td>
                        </tr>

                        @endif
                        @if($leaveApply->leave_type == 3)                        
                        <tr>
                          <td style="padding:10px" width = 50%><b>Name of the Employee  </b></td>
                          <td style="padding:10px">{{ ucwords(reportingName($leaveApply->user_id)) }}</td>
                        </tr>
                        <tr>
                          <td width = 50% style="padding:10px"><b>WFH Applied Date</b></td>
                          <td style="padding:10px">{{ date(setting('date_format'),strtotime($leaveApply->created_at))}}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>WFH Required From  </b></td>
                          <td style="padding:10px"> {{ date(setting('date_format'), strtotime($leaveApply->leave_from)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>WFH Required To  </b></td>
                          <td style="padding:10px"> {{ date(setting('date_format'), strtotime($leaveApply->leave_to)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Reporting To</b></td>
                          <td style="padding:10px"> {{$name}}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Reason  </b></td>
                          <td style="padding:10px">{{ ucfirst($leaveApply->reason) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Task Type  </b></td>
                          <td style="padding:10px">{{ $leaveApply->task_type == 1 ? 'Business Critical' : ($leaveApply->task_type == 2 ? 'Time Critical' : 'Both Business Critical & Time Critical') }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>{{ taskType($leaveApply->task_type) }}  </b></td>
                          <td style="padding:10px">{{ ucfirst($leaveApply->task_reason) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Work Plan  </b></td>
                          <td style="padding:10px">{{ ucfirst($leaveApply->task_plan) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50% ><b>WFH Status</b></td>
                          <td style="padding:10px"><b>{{ $leaveApply->status == 1 ? 'Pending' : ($leaveApply->status == 2 ? 'Approved' : 'Rejected') }} </b></td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <div align = "center" style="margin-top:2px;margin-bottom:2px;">
                            <button class="success-btn"><a style="text-decoration: none; color:white;"  class="success-btn" href="{{route('leave.show',$leaveApply->id)}}"><i aria-hidden="true" class="fa fa-check"></i>Approve</a></button>
                            <button class="danger-btn"><a style="text-decoration: none; color:white;" class="btn btn-danger btn-sm" href="{{route('leave.show',$leaveApply->id)}}"><i aria-hidden="true" class="fa fa-close"></i>Reject</a></button>
                            </div>
                          </td>
                        </tr>
                        @endif
                      </table>
                      <br><br>
                      @elseif($leaveApply->status == 2)
                      <table border="1" cellpadding="0" cellspacing="0" width="200px">
                        @if($leaveApply->leave_type == 1)
                       
                        <tr>
                          <td width = 50% style="padding:10px"><b>Name of the Employee </b></td>
                          <td style="padding:10px">{{ ucwords(reportingName($leaveApply->user_id)) }}</td>
                        </tr>
                        <tr>
                          <td width = 50% style="padding:10px"><b>Leave Applied Date</b></td>
                          <td style="padding:10px">{{ date(setting('date_format'),strtotime($leaveApply->created_at))}}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Leave Required From</b></td>
                          <td style="padding:10px"> {{ date(setting('date_format'), strtotime($leaveApply->leave_from)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Leave Required To</b></td>
                          <td style="padding:10px"> {{ date(setting('date_format'), strtotime($leaveApply->leave_to)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Reporting To</b></td>
                          <td style="padding:10px"> {{$name}}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Reason For The Leave  </b></td>
                          <td style="padding:10px">{{ ucfirst($leaveApply->reason) }}</td>
                        </tr>
                        <tr>
                          <td width = 50% style="padding:10px"><b>Leave Status</b></td>
                          <td style="padding:10px"><b>{{ $leaveApply->status == 1 ? 'Pending' : ($leaveApply->status == 2 ? 'Approved' : 'Rejected') }}</b>
                        </td>
                        </tr>
                        @if($leaveApply->status_reason != "")
                                <tr class = "reason">
                                    <td width = 50% style="padding:10px"><b>Reason</b></td>
                                    <td style="padding:10px">{{ucfirst($leaveApply->status_reason)}}</td>
                                </tr>
                                @endif
                       @elseif($leaveApply->leave_type == 4)
                       
                       <tr>
                         <td width = 50% style="padding:10px"><b>Name of the Employee </b></td>
                         <td style="padding:10px">{{ ucwords(reportingName($leaveApply->user_id)) }}</td>
                       </tr>
                       <tr>
                         <td width = 50% style="padding:10px"><b>Half Day Leave Applied Date</b></td>
                         <td style="padding:10px">{{ date(setting('date_format'),strtotime($leaveApply->created_at))}}</td>
                       </tr>
                       <tr>
                         <td style="padding:10px" width = 50%><b>Half Day Leave Required Date</b></td>
                         <td style="padding:10px"> {{ date(setting('date_format'), strtotime($leaveApply->leave_from)) }}</td>
                       </tr>
                       <tr>
                         <td style="padding:10px" width = 50%><b>Reporting To</b></td>
                         <td style="padding:10px"> {{$name}}</td>
                       </tr>
                       <tr>
                         <td style="padding:10px" width = 50%><b>Reason For The Leave  </b></td>
                         <td style="padding:10px">{{ ucfirst($leaveApply->reason) }}</td>
                       </tr>
                       <tr>
                         <td width = 50% style="padding:10px"><b>Leave Status</b></td>
                         <td style="padding:10px"><b>{{ $leaveApply->status == 1 ? 'Pending' : ($leaveApply->status == 2 ? 'Approved' : 'Rejected') }}</b>
                       </td>
                       </tr>
                       @if($leaveApply->status_reason != "")
                               <tr class = "reason">
                                   <td width = 50% style="padding:10px"><b>Reason</b></td>
                                   <td style="padding:10px">{{ucfirst($leaveApply->status_reason)}}</td>
                               </tr>
                        @endif
                        @elseif($leaveApply->leave_type == 2)
                        <tr>
                          <td style="padding:10px" width = 50%><b>Name of the Employee  </b></td>
                          <td style="padding:10px">{{ ucwords(reportingName($leaveApply->user_id)) }}</td>
                        </tr>
                        <tr>
                          <td width = 50% style="padding:10px"><b>Permission Applied Date</b></td>
                          <td style="padding:10px">{{ date(setting('date_format'),strtotime($leaveApply->created_at))}}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Permission Required Date</b></td>
                          <td style="padding:10px"> {{ date(setting('date_format'), strtotime($leaveApply->leave_from)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Permission Required From </b></td>
                          <td style="padding:10px"> {{ date(setting('time_format'), strtotime($leaveApply->leave_from)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Permission Required To </b></td>
                          <td style="padding:10px"> {{ date(setting('time_format'), strtotime($leaveApply->leave_to)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Reporting To</b></td>
                          <td style="padding:10px"> {{$name}}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Reason for the Permission  </b></td>
                          <td style="padding:10px">{{ ucfirst($leaveApply->reason) }}</td>
                        </tr>
                        <tr>
                          <td width = 50% style="padding:10px"><b>Permission Status</b></td>
                          <td style="padding:10px"><b>{{ $leaveApply->status == 1 ? 'Pending' : ($leaveApply->status == 2 ? 'Approved' : 'Rejected') }}</b></td>
                        </tr>
                        @if($leaveApply->status_reason != "")
                                <tr class = "reason">
                                    <td style="padding:10px" width = 50%><b>Reason</b></td>
                                    <td style="padding:10px">{{ucfirst($leaveApply->status_reason)}}</td>
                                </tr>
                                @endif

                        @endif
                        @if($leaveApply->leave_type == 3)                        
                        <tr>
                          <td style="padding:10px" width = 50%><b>Name of the Employee  </b></td>
                          <td style="padding:10px">{{ ucwords(reportingName($leaveApply->user_id)) }}</td>
                        </tr>
                        <tr>
                          <td width = 50% style="padding:10px"><b>WFH Applied Date</b></td>
                          <td style="padding:10px">{{ date(setting('date_format'),strtotime($leaveApply->created_at))}}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>WFH Required From  </b></td>
                          <td style="padding:10px"> {{ date(setting('date_format'), strtotime($leaveApply->leave_from)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>WFH Required To  </b></td>
                          <td style="padding:10px"> {{ date(setting('date_format'), strtotime($leaveApply->leave_to)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Reporting To</b></td>
                          <td style="padding:10px"> {{$name}}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Reason  </b></td>
                          <td style="padding:10px">{{ ucfirst($leaveApply->reason) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Task Type  </b></td>
                          <td style="padding:10px">{{ $leaveApply->task_type == 1 ? 'Business Critical' : ($leaveApply->task_type == 2 ? 'Time Critical' : 'Both Business Critical & Time Critical') }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>{{ taskType($leaveApply->task_type) }}  </b></td>
                          <td style="padding:10px">{{ ucfirst($leaveApply->task_reason) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Work Plan  </b></td>
                          <td style="padding:10px">{{ ucfirst($leaveApply->task_plan) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50% ><b>WFH Status</b></td>
                          <td style="padding:10px"><b>{{ $leaveApply->status == 1 ? 'Pending' : ($leaveApply->status == 2 ? 'Approved' : 'Rejected') }} </b></td>
                        </tr>
                        @if($leaveApply->status_reason != "")
                                <tr class = "reason">
                                    <td style="padding:10px" width = 50%><b>Reason</b></td>
                                    <td style="padding:10px">{{ucfirst($leaveApply->status_reason)}}</td>
                                </tr>
                                @endif
                        @endif
                      </table>
                      <br><br>
                      
                      @elseif($leaveApply->status == 3)
                      <table border="1" cellpadding="0" cellspacing="0" width="200px">
                        @if($leaveApply->leave_type == 1)
                       
                        <tr>
                          <td width = 50% style="padding:10px"><b>Name of the Employee </b></td>
                          <td style="padding:10px">{{ ucwords(reportingName($leaveApply->user_id)) }}</td>
                        </tr>
                        <tr>
                          <td width = 50% style="padding:10px"><b>Leave Applied Date</b></td>
                          <td style="padding:10px">{{ date(setting('date_format'),strtotime($leaveApply->created_at))}}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Leave Required From</b></td>
                          <td style="padding:10px"> {{ date(setting('date_format'), strtotime($leaveApply->leave_from)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Leave Required To</b></td>
                          <td style="padding:10px"> {{ date(setting('date_format'), strtotime($leaveApply->leave_to)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Reporting To</b></td>
                          <td style="padding:10px"> {{$name}}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Reason For The Leave  </b></td>
                          <td style="padding:10px">{{ ucfirst($leaveApply->reason) }}</td>
                        </tr>
                        <tr>
                          <td width = 50% style="padding:10px"><b>Leave Status</b></td>
                          <td style="padding:10px"><b>{{ $leaveApply->status == 1 ? 'Pending' : ($leaveApply->status == 2 ? 'Approved' : 'Rejected') }}</b>
                        </td>
                        </tr>
                        @if($leaveApply->status_reason != "")
                                <tr class = "reason">
                                    <td width = 50% style="padding:10px"><b>Reason</b></td>
                                    <td style="padding:10px">{{ucfirst($leaveApply->status_reason)}}</td>
                                </tr>
                        @endif
                        @elseif($leaveApply->leave_type == 4)
                       
                        <tr>
                          <td width = 50% style="padding:10px"><b>Name of the Employee </b></td>
                          <td style="padding:10px">{{ ucwords(reportingName($leaveApply->user_id)) }}</td>
                        </tr>
                        <tr>
                          <td width = 50% style="padding:10px"><b>Leave Applied Date</b></td>
                          <td style="padding:10px">{{ date(setting('date_format'),strtotime($leaveApply->created_at))}}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Half Day Leave Required Date</b></td>
                          <td style="padding:10px"> {{ date(setting('date_format'), strtotime($leaveApply->leave_from)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Reporting To</b></td>
                          <td style="padding:10px"> {{$name}}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Reason For The Leave  </b></td>
                          <td style="padding:10px">{{ ucfirst($leaveApply->reason) }}</td>
                        </tr>
                        <tr>
                          <td width = 50% style="padding:10px"><b>Leave Status</b></td>
                          <td style="padding:10px"><b>{{ $leaveApply->status == 1 ? 'Pending' : ($leaveApply->status == 2 ? 'Approved' : 'Rejected') }}</b>
                        </td>
                        </tr>
                        @if($leaveApply->status_reason != "")
                                <tr class = "reason">
                                    <td width = 50% style="padding:10px"><b>Reason</b></td>
                                    <td style="padding:10px">{{ucfirst($leaveApply->status_reason)}}</td>
                                </tr>
                        @endif
                        @elseif($leaveApply->leave_type == 2)
                        <tr>
                          <td style="padding:10px" width = 50%><b>Name of the Employee  </b></td>
                          <td style="padding:10px">{{ ucwords(reportingName($leaveApply->user_id)) }}</td>
                        </tr>
                        <tr>
                          <td width = 50% style="padding:10px"><b>Permission Applied Date</b></td>
                          <td style="padding:10px">{{ date(setting('date_format'),strtotime($leaveApply->created_at))}}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Permission Required Date</b></td>
                          <td style="padding:10px"> {{ date(setting('date_format'), strtotime($leaveApply->leave_from)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Permission Required From </b></td>
                          <td style="padding:10px"> {{ date(setting('time_format'), strtotime($leaveApply->leave_from)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Permission Required To </b></td>
                          <td style="padding:10px"> {{ date(setting('time_format'), strtotime($leaveApply->leave_to)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Reporting To</b></td>
                          <td style="padding:10px"> {{$name}}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Reason for the Permission  </b></td>
                          <td style="padding:10px">{{ ucfirst($leaveApply->reason) }}</td>
                        </tr>
                        <tr>
                          <td width = 50% style="padding:10px"><b>Permission Status</b></td>
                          <td style="padding:10px"><b>{{ $leaveApply->status == 1 ? 'Pending' : ($leaveApply->status == 2 ? 'Approved' : 'Rejected') }}</b></td>
                        </tr>
                        @if($leaveApply->status_reason != "")
                                <tr class = "reason">
                                    <td width = 50% style="padding:10px"><b>Reason</b></td>
                                    <td style="padding:10px">{{ucfirst($leaveApply->status_reason)}}</td>
                                </tr>
                                @endif

                        @endif
                        @if($leaveApply->leave_type == 3)                        
                        <tr>
                          <td style="padding:10px" width = 50%><b>Name of the Employee  </b></td>
                          <td style="padding:10px">{{ ucwords(reportingName($leaveApply->user_id)) }}</td>
                        </tr>
                        <tr>
                          <td width = 50% style="padding:10px"><b>WFH Applied Date</b></td>
                          <td style="padding:10px">{{ date(setting('date_format'),strtotime($leaveApply->created_at))}}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>WFH Required From  </b></td>
                          <td style="padding:10px"> {{ date(setting('date_format'), strtotime($leaveApply->leave_from)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>WFH Required To  </b></td>
                          <td style="padding:10px"> {{ date(setting('date_format'), strtotime($leaveApply->leave_to)) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Reporting To</b></td>
                          <td style="padding:10px"> {{$name}}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Reason  </b></td>
                          <td style="padding:10px">{{ ucfirst($leaveApply->reason) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Task Type  </b></td>
                          <td style="padding:10px">{{ $leaveApply->task_type == 1 ? 'Business Critical' : ($leaveApply->task_type == 2 ? 'Time Critical' : 'Both Business Critical & Time Critical') }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>{{ taskType($leaveApply->task_type) }}  </b></td>
                          <td style="padding:10px">{{ ucfirst($leaveApply->task_reason) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50%><b>Work Plan  </b></td>
                          <td style="padding:10px">{{ ucfirst($leaveApply->task_plan) }}</td>
                        </tr>
                        <tr>
                          <td style="padding:10px" width = 50% ><b>WFH Status</b></td>
                          <td style="padding:10px"><b>{{ $leaveApply->status == 1 ? 'Pending' : ($leaveApply->status == 2 ? 'Approved' : 'Rejected') }} </b></td>
                        </tr>
                        @if($leaveApply->status_reason != "")
                                <tr class = "reason">
                                    <td style="padding:10px" width = 50% ><b>Reason</b></td>
                                    <td style="padding:10px">{{ucfirst($leaveApply->status_reason)}}</td>
                                </tr>
                                @endif
                        @endif
                      </table>
                      <br><br>
                     
                      @endif

                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <!-- END MAIN CONTENT AREA -->
          </table>
          <!-- END CENTERED WHITE CONTAINER -->
          <!-- END FOOTER -->
        </div>
      </td>
      <td>&nbsp;</td>
    </tr>
  </table>
</body>

</html>