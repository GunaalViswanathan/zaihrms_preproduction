@extends('larasnap::layouts.app', ['class' => 'document-index'])
@section('title','Email Cadences')
@section('content')

<div id="heading1" class="d-sm-flex align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Customer Type</h1>
    <div class="dropdown show ml-2">

        <a class="btn btn-secondary dropdown-toggle" href="{{route('email_cadences.direct_client')}}" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Direct Clients
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{route('email_cadences.white_labelled')}}">White-labelled Partners </a>
            <a class="dropdown-item" href="{{route('email_cadences.technology')}}">Technology Partners </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-body document-text" id="coding_standards">
                <div id="heading1" class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Direct Client</h1>
                </div>
                <div id="accordion" class="myaccordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Cold Email
                                    <span class="fa-stack fa-sm">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <p><b>Subject:</b></p>
                                <ul>
                                    <li>
                                        <b>Option 1 - </b> I believe we need to talk
                                    </li>
                                    <li>
                                        <b>Option 2 - </b> Can I help you with the project you’re working on?

                                    </li>
                                    <li>
                                        <b>Option 3 - </b> Available for a chat?
                                    </li>
                                    <li>
                                        <b>Option 4 - </b> Key to (company’s name) growth
                                    </li>
                                </ul>
                                <p><b>Body:</b></p>
                                <p>Hi [name]</p>
                                <p>My name is [rep’s name] with Zaigo Infotech.</p>
                                <p>I found you through (Linkedin/google/Twitter) as I was looking for individuals and companies that can benefit from our custom software development services. </p>
                                <p>At Zaigo, we work with multiple early-stage and established companies, helping them in their digital transformation journey by building A-class mobile, web, and SaaS applications. Our customers feel that we have a highly qualified team with specialist tech skills and expertise ready to deliver reliable, custom software solutions.</p>
                                <p>And you are very well aware that without a flexible, equipped, and reliable outsourced team your productivity will take a dip, higher project risks, and project execution will take forever.</p>
                                <p>So, I wanted to share some of the ways we can help you avoid the aforementioned failures, aid you in your ongoing and upcoming projects and also discuss the revenue results of working with us.</p>
                                <p>Are you available for a brief call (next week)? </p>
                                <p>Thanks<br>[rep’s name]</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Cold email – 1st follow-up
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <p><b>Subject:</b></p>
                                <ul>
                                    <li>
                                        <b>Option 1:</b> Am I assuming correctly?
                                    </li>
                                    <li>
                                        <b>Option 2:</b> What would it take?
                                    </li>
                                </ul>
                                <p><b>Body:</b></p>
                                <p>Hi [name]</p>
                                <p>
                                    I trust you had the time to look at my previous email and get familiar with the services we offer, so I figured it’d be worth checking with you again.
                                </p>
                                <p>
                                    Just in case you’re unable to recollect, I am [name] with Zaigo Infotech. In our 6+ years of experience serving companies such as First Batch Hospitality,(placeholder), and several others, we’ve built them exceptional mobile, web, and SaaS applications, helped them reach 30% hours of productivity and saved them about 20% by overall cost-cutting. Our team of custom software development experts can be the most appropriate addition to your in-house team. They are skilled and can complete projects on time, within the budget, and with great quality.
                                </p>
                                <p>
                                    On that note, I’d love to set up a time to walk you through our services and processes. Would you have some time next week to connect?
                                </p>
                                <p>Regards<br>[rep’s name]</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwosecond">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwosecond" aria-expanded="false" aria-controls="collapseTwosecond">
                                    Cold email – 2nd follow-up
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwosecond" class="collapse" aria-labelledby="headingTwosecond" data-parent="#accordion">
                            <div class="card-body">
                                <p><b>Subject:</b>
                                <p>
                                <ul>
                                    <li><b>Option 1:</b> Do you remember? </li>
                                    <li><b>Option 2:</b> You don’t want to miss this!</li>
                                    <li><b>Option 3:</b> Probably my final check-in</li>
                                </ul>
                                <p><b>Body:</b>
                                <p>Hi (first name),</p>
                                <p>I’ve tried to reach you a few times to go over suggestions on how you can utilize our services and maximize your ROI, but haven’t heard back.</p>
                                <p>Are you interested in engaging with a company like us that offers a range of custom software development services-personalized web & mobile applications, SaaS applications, tech integrations, etc. with which you can leap ahead of your rivals?</p>
                                <p>Let me know with a yes or no. Looking forward!</p>
                                <p>Regards<br>(rep’s name)</p>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Email After Voice Email
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                <p><b>Subject:</b></p>
                                <ul>
                                    <li><b>Option 1:</b> (prospect’s name), trying to connect with you</li>
                                    <li><b>Option 2:</b> Re: my last voicemail</li>
                                    <li><b>Option 3:</b> I just called you...</li>
                                </ul>
                                <p><b>Body:</b></p>
                                <p>Hey (name),</p>

                                <p>I just left you a voicemail but wanted to drop you a line by email in case this is more convenient for you.</p>

                                <p>I’m reaching out because it looks like for a business like yours we can be the most appropriate team to work with. I am (rep’s name) representing Zaigo Infotech, we are on a mission to bring all great ideas to the market by building them with exceptional skills and needed technical expertise.</p>

                                <p>We’ve experience working with companies like First Batch Hospitality, (placeholder), and many others, where we built them seamless mobile, web, and SaaS applications and helped them scale their productivity x times. Our custom software development experts can add immense value to your in-house team.</p>

                                <p>(prospect’s first name), I’d love to connect about your specific needs. I also have a suggestion about how you can double down on your revenue by leveraging our offerings.</p>

                                <p>Give me a call back at (phone number) if convenient, or feel free to reply to this email.</p>

                                <p>Thanks!<br>
                                    (rep’s name)</p>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Follow-up Email After Voicemail
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="card-body">
                                <p><b>Subject:</b></p>

                                <ul>
                                    <li><b>Option 1:</b> Let’s try this again</li>
                                    <li><b>Option 2:</b> Is there a convenient time to talk to you?</li>
                                    <li><b>Option 3:</b> I’ve sent you a voicemail</li>
                                    <li><b>Option 4:</b> Missed you again</li>
                                </ul>
                                <p><b>Body:</b></p>


                                <p>Hi (name),</p>

                                <p>I left you a voicemail (earlier today) to schedule a time to discuss how we can add value to your business. I am (rep’s name) with Zaigo Infotech, where we build the need-of-the-hour software and applications for businesses to stay relevant and also succeed in the long haul. We’re excited to show you how we help our clients boost revenue and also save time and dollars.</p>

                                <p>I mentioned that I’d call again (time mentioned in the voice mail) but feel free to contact me by email if that works better for you.</p>

                                <p>Looking forward to chatting with you soon!</p>

                                <p>Best<br>
                                    (rep’s name)</p>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Email After Initial cold phone connect
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                            <div class="card-body">
                                <p><b>Subject:</b></p>

                                <ul>
                                    <li><b>Option 1:</b> Zaigo Infotech + (company’s name)</li>
                                    <li><b>Option 2:</b> Our next steps</li>
                                    <li><b>Option 3:</b> Before you decide…</li>
                                </ul>
                                <p><b>Body:</b></p>

                                <p>Hi there,</p>

                                <p>I appreciate the brief call we had the other day!</p>

                                <p>As promised on call, I’ve attached more information about our services and how we can help you boost revenue instantly.</p>

                                <p><b>Quick intro:</b> I am (rep’s name) with Zaigo Infotech. We have years of quality experience building web, mobile, and SaaS applications for a wide range of customers, and can certainly provide you with excellent expertise to build software/applications that will best serve you in attaining all your business goals. And with a flexible, equipped, reliable outsourced team like ours you can be confident about the raise in your overall productivity, project security, and speedy execution of the project.</p>

                                <p>Just let me know if you have any questions and I’d be more than happy to chat again. If not, I look forward to talking to you again on [date and time].</p>

                                <p>Thanks and speak soon,<br>
                                    (rep’s name)</p>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingSix">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    Email follow-up after initial connect
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                            <div class="card-body">
                                <p><b>Subject:</b></p>

                                <ul>
                                    <li><b>Option 1:</b> Still any interest in our service?</li>
                                    <li><b>Option 2:</b> Are you ready for this?</li>
                                    <li><b>Option 3:</b> Here’s the information you requested</li>
                                </ul>
                                <p><b>Body:</b></p>

                                <p>Hi there,</p>

                                <p>After we last chatted I’d sent you some information about our services. Hope you had the time to go through them.</p>

                                <p>I’m sure improving your (objective) is one of your company’s main priorities, so I thought it would be great to contact you right away. If you’d like any additional information about our services and anything related to it at all, I’d be more than happy to have a quick chat over the phone.</p>

                                <p>Just let me know if you have any questions or would like to have a more in-depth conversation. I’m ready and waiting.</p>

                                <p>Best<br>
                                    (rep’s signature)</p>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingSeven">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    Email After initial presentation meeting
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                            <div class="card-body">
                                <p><b>Subject:</b></p>

                                <ul>
                                    <li><b>Option 1:</b> Zaigo Infotech + (company’s name)</li>
                                    <li><b>Option 2:</b> Our next steps</li>
                                    <li><b>Option 3:</b> Before you decide…</li>
                                </ul>
                                <p><b>Body:</b></p>

                                <p>Hi there,</p>

                                <p>I really enjoyed chatting with you earlier today and learning more about how you are impacting the growth of (company’s name) and what lies in your roadmap. I understand the issues you’re encountering with [challenges discussed in conversation] and how they make it harder for you and your team to reach goals.</p>

                                <p>Like I mentioned, as we have years of quality experience building web, mobile, and SaaS applications for a wide range of customers, we can certainly provide you with excellent expertise to build software/applications that will best serve you in attaining all your business goals. And with a flexible, equipped, reliable outsourced team like ours you can be confident about the raise in your overall productivity, project security, and speedy execution of the project.</p>

                                <p>As promised on call, I’ve attached more information about our services and how we can help you boost revenue instantly.</p>

                                <p>Just let me know if you have any questions and I’d be more than happy to chat again. If not, I look forward to talking to you again on [date and time].</p>

                                <p>Thanks and speak soon,<br>
                                    (rep’s name)</p>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingEight">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                    After Presentation Follow-up Email
                                    <span class="fa-stack fa-2x">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
                            <div class="card-body">
                                <p><b>Subject:</b></p>

                                <ul>
                                    <li><b>Option 1:</b> Discussing your future goals today</li>
                                    <li><b>Option 2:</b> Are you ready for the next step?</li>
                                    <li><b>Option 3:</b> Here’s the information you requested</li>
                                </ul>
                                <p><b>Body:</b></p>

                                <p>Hi (Name)</p>

                                <p>I’d like to thank you for taking the time to hear me out on (day). I’m really excited about the potential of this relationship.</p>

                                <p>I’m sure improving your (objective) is one of your company’s main priorities, so I thought it would be great to contact you right away. I thought I’d send more information about our services for you to review. If you’d like any additional information about this, I’d be more than happy to have a quick chat over the phone.</p>

                                <p>Just let me know if you have any questions or would like to have a more in-depth conversation. I’m ready and waiting.</p>

                                <p>Best<br>
                                    (rep’s signature)</p>

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