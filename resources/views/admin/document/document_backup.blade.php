@extends('larasnap::layouts.app', ['class' => 'document-index'])
@section('title','document List')
@section('content')
<div class="documentation">
    <ul id="my_id">

        <li><a href="{{route('document.index')}}">Coding Best Practices</a></li>
        <li><a href="{{route('document.qa_process')}}">QA Process</a></li>
        <li><a href="{{route('document.saas_tech')}}">SaaS Tech Stack</a></li>
        <li><a href="">Backup Process</a></li>


    </ul>
</div>
<div id="heading1" class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Source Code Backup</h1>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-body document-text" id="coding_standards">
                <h3>Introduction</h3>
                <p>
                    The purpose of the code backup is to create a copy of source code that can be recovered in the event of primary data tampering or accidental source code deletion or the organization to download any source code from a centralized location. Zaigo has the following assets as part of its development and business processes: </p>
                <ul>
                    <li>Software Assets
                        <ul>
                            <li>Source code for various projects
                                <ul>
                                    <li>PHP</li>
                                    <li>HTML / JS / CSS</li>
                                    <li>Database</li>
                                </ul>
                            </li>
                            <li>UI / UX Design</li>
                            <li>Third party SDK / Libraries</li>
                            <li>Documents
                                <ul>
                                    <li>Design Document</li>
                                    <li>Technical and Commercial Proposal</li>
                                    <li>User Manuals</li>
                                    <li>DB Architecture</li>
                                    <li>API Guide</li>
                                    <li>Source Code Documentation</li>
                                    <li>Test Cases and Test Reports</li>
                                    <li>Mail Communication</li>
                                    <li>Effort Estimates</li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>Hardware Assets
                        <ul>
                            <li>Laptop</li>
                            <li>Server</li>
                            <li>External hard disk / USB drive</li>
                            <li>Routers / Switches</li>
                            <li>Attendance System</li>
                            <li>Printers</li>
                            <li>POS / Card reader / fingerprint scanner</li>
                        </ul>
                    </li>
                </ul>
                <p>
                All the above assets are valuable for the organization and proper maintenance and backup is mandatory for the business continuity and disaster management handling. This document outlines the process to be followed for regular backup of all software assets and the process to be followed for hardware assets  
                </p>
                <div id="accordion" class="myaccordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Backup Process
                                    <span class="fa-stack fa-sm">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    <li>
                                        Team leaders / Managers will be provided with an account in the backup server with separate login credentials.
                                        <ul>
                                            <li>
                                                Team leaders should collect all the required content to be backed up and place it in the backup system
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        All the backup files will be stored in zip format and it will not be encrypted
                                    </li>
                                    <li>
                                        The base directory name in the backup location will be created based on the customer or project or product name
                                    </li>
                                    <li>
                                        Zip file name will follow the below naming convention
                                        <ul>
                                            <li>
                                                < CustomerName/Project Name/Product Name>_< DDMMYYYY>_< Version Number (if any)>.zip
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        If multiple team members are working on the same project, then leader should collate all the source code or modules into one single directory structure, zip the filer and place it in the backup system
                                    </li>
                                    <li>
                                        Source codes updated in github / gitlab should also be backed up in the backup server
                                    </li>
                                    <li>
                                        The backup file can be placed in the backup directory on the following events:
                                        <ul>
                                            <li>
                                                A project is completed and delivered to the customer
                                            </li>
                                            <li>
                                                A project version is delivered to QA for testing
                                            </li>
                                            <li>
                                                Project is in development stage and scheduled backup on <b>last working day of the week</b>
                                            </li>
                                            <li>
                                                Project manager should also collect the test cases and test reports for the project and include in their documentation
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        QA team should maintain the similar structure and will have all the release files as one major directory
                                    </li>
                                    <li>
                                        Backup will always be complete and it should not be an incremental backup
                                    </li>
                                    <li>
                                        The directory structure in the backup system will be:
                                        <ul>
                                            <li>
                                                < Customer Name / Project Name / Product Name>
                                                    <ul>
                                                        <li>
                                                            DDMMYYYY
                                                            <ul>
                                                                <li>
                                                                    Src - Source Files / Release Files
                                                                    <ul>
                                                                        <li>
                                                                            All source files should be consolidated into a structured directory
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                <li>
                                                                    Docs – Documents
                                                                    <ul>
                                                                        <li>
                                                                            All the documents should be placed as individual files and it should not be in zip format
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li>
                                                            :
                                                        </li>
                                                        <li>
                                                            :
                                                        </li>
                                                    </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        Once the backup is taken, an email intimation should be sent to CTO and CEO
                                    </li>
                                    <li>
                                        If the leader or manager is on leave on the last working day or any such event requires backup, then they should assign a next level team member to backup the files. The credentials should be shared with the team member.
                                        <ul>
                                            <li>
                                                The login credential password should be changed when the leader / manager join office
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        The password should be periodically changes (period being every 1 month)
                                    </li>
                                    <li>
                                        The password should be circulated to CTO / CEO
                                    </li>
                                    <li>
                                        Any storage related issues in the backup server should be intimated to CTO / CEO to increase the volume size and that should not be an excuse for not backing up the files in the backup server
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Hardware Assets
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <p>All the hardware assets will be managed by an Admin team. They will maintain the complete inventory and tracking of the assets. There will be a specific register available with admin team who tracks the assets movement, employee who hold the asset and the period. The asset should be handed over back to admin team post usage and the custody of the assets can be taken for a specific period. Employees should take responsibility for any damage of the asset. Admin team should check for any damage of the asset before taking the control of the asset from the employee. This sheet / register should be available to the management at any point of time.</p>
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