@extends('larasnap::layouts.app', ['class' => 'document-index'])
@section('title','document List')
@section('content')
<div class="documentation">
    <ul id="my_id">

        <li><a href="{{route('document.index')}}">Coding Best Practices</a></li>
        <li><a href="">QA Process</a></li>
        <li><a href="{{route('document.saas_tech')}}">SaaS Tech Stack</a></li>
        <li><a href="{{route('document.backup')}}">Backup Process</a></li>


    </ul>
</div>
<div id="heading1" class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">QA Process</h1>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-body document-text" id="coding_standards">
                <h3>Introduction</h3>
                <p>
                    Quality Assurance is defined as a procedure to ensure the quality of software products or services provided to the customer. This helps in improving the software development process and making it efficient and effective as per the quality standards defined for applications. The list of processes followed in QA are: </p>
                <ul>
                    <li>Review of Requirements</li>
                    <li>Test Planning / Writing Test Cases
                        <ul>
                            <li>
                                Test case to include detailed information on all the inputs and response of the working of the application. This step is carried out to determine the completeness of the feature of the product
                            </li>
                        </ul>
                    </li>
                    <li>Unit Testing
                        <ul>
                            <li>
                                Done for small level of requirements regarding the application classes, interfaces and APIs used in it
                            </li>
                        </ul>
                    </li>
                    <li>Integration Testing
                        <ul>
                            <li>
                                Testing different components of the system and key interfaces inside the products
                            </li>
                        </ul>
                    </li>
                    <li>System Testing
                        <ul>
                            <li>
                                Risk based and specific requirement-based testing for the complete application
                            </li>
                        </ul>
                    </li>
                    <li>Performance Testing
                        <ul>
                            <li>
                                Testing performance of the product depending upon the workload
                            </li>
                        </ul>
                    </li>
                    <li>Security Testing
                        <ul>
                            <li>
                                Testing the security and login system of the application and checking out various vulnerability testing as per OWASP and CVE standards
                            </li>
                        </ul>
                    </li>
                    <li>Cross-Browser / Cross-Platform Testing
                        <ul>
                            <li>
                                Testing to be carried out to check the application capability to function across various browser and also various platforms
                            </li>
                        </ul>
                    </li>
                    <li>Updating Test Cases
                        <ul>
                            <li>
                                Keep updating test cases
                            </li>
                        </ul>
                    </li>
                    <li>Regression Testing
                        <ul>
                            <li>
                                Based on error or fault is detected and application go through certain changes
                            </li>
                        </ul>
                    </li>
                </ul>

                <img align="center" src="{{storageUrl('public/document/image1.jpg')}}" alt="Girl in a jacket" width="100%" height="50%">
                <h3>Zaigo QA Process</h3>
                <p>
                    Zaigo follows both white box and black box testing as part of its quality assurance to its customers.
                </p>
                <table>
                    <tr>
                        <th width="50%" style="text-align: center;">Black Box Testing</th>
                        <th width="50%" style="text-align: center;">White Box Testing</th>
                    </tr>
                    <tr>
                        <td>High level testing to focus on behavior of the software</td>
                        <td>Low level testing to check the internal functioning of the system</td>
                    </tr>
                    <tr>
                        <td>Testing from an external or end-user perspective</td>
                        <td>Testing based on coverage of code statements, branches, paths or conditions. Carries out memory level testing also to calculate usage of memory during the execution and considering the scalability</td>
                    </tr>
                    <tr>
                        <td>Applies to unit, integration, system and acceptance testing</td>
                        <td>Logic in a unit or program is required for testing </td>
                    </tr>
                </table>
                <div id="accordion" class="myaccordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Requirement Gathering
                                    <span class="fa-stack fa-sm">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>


                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <img align="center" src="{{storageUrl('public/document/image2.jpg')}}" style="margin-left: 25%;" alt="Girl in a jacket" width="50%" height="50%">
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Test Strategy
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <img align="center" src="{{storageUrl('public/document/image3.jpg')}}" style="margin-left: 25%;" alt="Girl in a jacket" width="50%" height="50%">

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Test Planning
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">

                                <ul>
                                    <li>Not to leave out any feature or functionality in the application</li>
                                    <li>Create a matrix of environment so that software is tested on all platforms and browsers</li>
                                    <li>Create a matrix of environment on various databases that application can work</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                    Testing
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="card-body">
                                <img align="center" src="{{storageUrl('public/document/image4.jpg')}}" style="margin-left: 25%;" alt="Girl in a jacket" width="50%" height="50%">
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                                    Pre-Release Plan
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    <li>QA to ensure all the features on all the platforms are tested</li>
                                    <li>Highlight the areas which are not tested and that needs more testing efforts</li>
                                    <li>Prepare a matrix on all test results</li>
                                    <li>Application health card to stakeholders during the QA testing process</li>
                                    <li>Proper release document to be drafted</li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingSix">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseThree">
                                    QA Testing Tools
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                            <div class="card-body">
                                <p>Zaigo uses various testing tools to carry out the QA Process and identifying bugs:</p>
                                <ul>
                                    <li>Curl</li>
                                    <li>Ab (Apache bench marking tools)</li>
                                    <li>JMeter</li>
                                    <li>Postman</li>
                                    <li>Selenium scripts developed in Java for automated testing</li>
                                    <li>Vulnerability Assessment and Penetration testing tools
                                        <ul>
                                            <li>Burpsuite</li>
                                            <li>Acunetix</li>
                                        </ul>
                                    </li>
                                    <li>SOAPUI – Wherever the application uses SOAP and also used for web service testing</li>
                                </ul>
                                <p>In addition to all these tools, manual testing is also carried out to adhere to the conformance of the application specification</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingSeven">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    Bug Tracking tool
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                <li>Google sheet</li>
                                <li>gitlab</li>
                                <li>Teamworks</li>
                                </ul>
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

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
</style>