@extends('larasnap::layouts.app', ['class' => 'document-index'])
@section('title','document List')
@section('content')
<div class="documentation">
    <ul id="my_id">
        
        <li><a href="">Coding Best Practices</a></li>
        <li><a href="{{route('document.qa_process')}}">QA Process</a></li>
        <li><a href="{{route('document.saas_tech')}}">SaaS Tech Stack</a></li>
        <li><a href="{{route('document.backup')}}">Backup Process</a></li>

        
    </ul>
</div>
<div id="heading1" class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Coding Standards and Guidelines</h1>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-body document-text" id="coding_standards">
                <h3>Introduction</h3>
                <p>
                    Zaigo has provided the guidelines for the programmers to maintain well-defined and standard style of coding called coding standards. The purpose of setting up these coding standards are:
                </p>
                <ul>
                    <li>To give a uniform appearance to codes written by different programmers</li>
                    <li>Readability and maintainability of the code to reduce the complexity of the code</li>
                    <li>Code reuse and error detection becomes easier</li>
                </ul>
                <p>
                    These standards provide sound programming practices and increases the efficiency of the programmers.
                </p>
                <p>
                    The standards and guidelines mentioned below are applicable based on the programming language chosen for different projects.
                </p>
                <h3>Standards and Guidelines</h3>
                <div id="accordion" class="myaccordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Limited use of global variables
                                    <span class="fa-stack fa-sm">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <p>
                                    Application should avoid using global and wherever there is a need it should be used in limited manner. It is always a best practice to pass the variable required for the function to be supplied as parameter to the function.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Standard Headers
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <p>The programmer should add the following header information to the code for better understanding and maintenance of the code.</p>
                                <ul>
                                    <li>Name of the module</li>
                                    <li>Date of module creation</li>
                                    <li>Author of the module</li>
                                    <li>Modification history with version maintenance</li>
                                    <li>Synopsis or brief description about the module </li>
                                    <li>Different functions supported in the module along with I/O (Input / Output ) parameters and tagging as local or global (local being function used only in this module and global being function called from other modules)</li>
                                    <li>Global variables accessed or modified by this module</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Naming Conventions
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                <p>Meaningful variable names should be used across the application. The following rules are applicable for the following variable types:</p>
                                <ul>
                                    <li>Local variable names should be camel case lettering starting with small letter (e.g. localValue, totalPrice, basePrice)</li>
                                    <li>Global variable names should start with capital letter (e.g. GlobalValue, TotalRevenue)</li>
                                    <li>Constant variable names should be all capital letters (e.g. CONSVALUE)</li>
                                    <li>Avoid usage of digit in variable names unless the programming language demand for</li>
                                    <li>Name of the function should be camel case starting with small letter</li>
                                    <li>Name of the function should be meaningful and should be clear</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                    Indentation
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="card-body">
                                <p>All program or modules should be properly indented to increase the readability of the code. All programs should have properly white space with the following rules:</p>
                                <ul>
                                    <li>Provide space between the variable name and value assignment</li>
                                    <li>All lines should end with the line delimiter as defined in the respective programming language</li>
                                    <li>When defining the variable names in the function definition, space should be provided after giving a comma between two function arguments</li>
                                    <li>Nested block should be properly indented and spaced</li>
                                    <li>Proper indentation at the start and end of each block</li>
                                    <li>All braces should start from a new line</li>
                                    <li>Code following the end of braces should start from a new line </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                                    Error Handling
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                            <div class="card-body">
                                <p>All functions encountering an error condition should return true / false or 0 / error code for simplifying the debugging. All the error conditions or assertion should be handled in the program properly and adequate cleaning up of memory should be carried out before returning from a function or exiting the application. </p>
                                <p>All the error codes should be grouped and the error number should indicate clearly the module from which the error is triggered rather than debugging the code from the start to end of the application.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingSix">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseThree">
                                    API Definition
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                            <div class="card-body">
                                <p>All the service level and configuration level API should be well defined. Avoid using any proprietary form of data exchange between 2 applications. Adhere to the standards like REST / SOAP / JSON for any data exchange. API should be documented and it should go through separate testing cycle before integrating with the complete application.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingSeven">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    Validation
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                            <div class="card-body">
                                <p>Almost any source of data can be an injection vector, environment variables, parameters, external and internal web services, and all types of users. Injection flaws occur when an attacker can send hostile data to an interpreter.</p>
                                <p>All input / data provided by the user should be validated, filtered and sanitized at both client and server side. The value should be strictly checked against the data type. Use positive or whitelist server-side input validation. </p>
                                <p>If the database query is directly constructed at the application and if the query uses any data received from user, then application should use dynamic queries with proper escaping of the values or parameterized calls.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingEight">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                    Sensitive Data Exposure
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
                            <div class="card-body">
                                <p>Classify all the details stored in database or configuration file as sensitive or insensitive. Application should protect the data in transit and at rest (like passwords, credit card number, health cards, personal information and business secrets). Always use HTTPS / SSL communication between entities wherever the data is exchanged between 2 applications or between client (browser) and server. Wherever data at rest is classified as sensitive, required hashing or encryption standards to be used at the application or database level.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingNine">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                    Access Control
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordion">
                            <div class="card-body">
                                <p>Access control enforces policy such that users cannot act outside of their intended permissions. Failures typically lead to unauthorized information disclosure, modification or destruction of all data or performing the business function outside the limits of the user.</p>
                                <p>Any module that is processed at the application end should be checked for the logged in user’s access control before processing the request at the server side.</p>
                                <p>Classify the request as public or sensitive. All the JWT or OAUTH tokens used by the application during the active session should be invalidated when the user logout or when the login process is broken.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTen">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                    Logging and Monitoring
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordion">
                            <div class="card-body">
                                <p>Logging and Monitoring is one of the important aspects of any application for troubleshooting and also to analyze and any suspected activities. </p>
                                <p>As per the risk of the data stored or processed by the application:</p>
                                <ul>
                                    <li>Ensure all login, access control failures, and server-side input validation failures be logged with sufficient user context to identify suspicious or malicious accounts, and held for sufficient time to allow delayed forensic analysis.</li>
                                    <li>Ensure that logs are generated in a format that can be easily consumed by a centralized log management solution.</li>
                                    <li>Ensure high-value transactions have an audit trail with integrity controls to prevent tampering or deletion, such as append-only database tables or similar.</li>
                                    <li>Establish effective monitoring and alerting such that suspicious activities are detected and responded to in a timely fashion</li>
                                </ul>
                                <p>Additionally, when logging is enabled, sensitive details like passwords / IP address of the system should not be written in the log file.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingEleven">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                                    System Level functions
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseEleven" class="collapse" aria-labelledby="headingEleven" data-parent="#accordion">
                            <div class="card-body">
                                <p>Programmer should avoid any system level function through scripting to be executed from the application to avoid any kind of accidental deletion through an invalid input supplied by the user. If there is a need for any system level functions to be used at the application, then adequate sanitizing of input should be carried out.</p>                                
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwelve">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                                    Documentation
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwelve" class="collapse" aria-labelledby="headingTwelve" data-parent="#accordion">
                            <div class="card-body">
                                <p>All function and modules should have a clear description. The description should cover the following details</p>
                                <ul>
                                    <li>Purpose of the function</li>
                                    <li>Input / Output variable details</li>
                                    <li>Logic behind the function</li>
                                    <li>Error handling</li>
                                    <li>Any specific logic handled in the function based on customer requirement</li>
                                    <li>Version Number</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThirteen">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                                    Version Management
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThirteen" class="collapse" aria-labelledby="headingThirteen" data-parent="#accordion">
                            <div class="card-body">
                                <p>Proper versioning of the program / application should be followed. Any change at the application level should be classified as major / minor / internal.  The documentation and API definition / modification should also </p>
                                <p>A naming convention is a set of unwritten rules you should use if you want to increase the readability of the whole data model. When naming tables, use singular for the table name or use plural.  For separating words in database object name, use underscore.</P>
                                <p>Define the primary and foreign key relationship properly. All the variables declared as string or varchar should be defined with proper sizing and it should not be configured with default values or the same size for all data columns. Adequate care should be given for the database table design for data type and data column size definition.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $("#accordion").on("hide.bs.collapse show.bs.collapse", e => {
        $(e.target)
            .prev()
            .find("i:last-child")
            .toggleClass("fa-minus fa-plus");
    });
</script>
@endsection
<style type="text/css">
    .documentation ul {
        padding: 10px 0;
        list-style: none;
        background: #3c8dbc !important;
        display: inline-block;
        width: 100%;
    }

    .documentation ul li {
        float: left;
    }

    .documentation ul li a {
        color: #fff;
        font-size: 16px;
        padding: 0px 15px;
        border-right: 1px solid #fff;
    }

    .document-text h3 {
        color: #555;
        font-weight: bold;
    }

    .myaccordion {
        max-width: 100%;
        margin: 0px auto;
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.3);
    }

    .myaccordion .card,
    .myaccordion .card:last-child .card-header {
        border: none;
    }

    .myaccordion .card-header {
        border-bottom-color: #EDEFF0;
        background: transparent;
    }

    .myaccordion .fa-stack {
        font-size: 18px;
    }

    .myaccordion .btn {
        width: 100%;
        font-weight: bold;
        color: #004987;
        padding: 0;
    }

    .myaccordion .btn-link:hover,
    .myaccordion .btn-link:focus {
        text-decoration: none;
    }

    .myaccordion li+li {
        margin-top: 10px;
    }

    .myaccordion .card-header {
        padding: 5px 10px;
        margin-bottom: 0;
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
    }

    .myaccordion h2 button {
        font-size: 20px;
    }
</style>