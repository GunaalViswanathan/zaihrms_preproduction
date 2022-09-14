@extends('larasnap::layouts.app', ['class' => 'document-index'])
@section('title','Email Cadences')
@section('content')

<div id="heading1" class="d-sm-flex align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Customer Type</h1>
    <div class="dropdown show ml-2">

        <a class="btn btn-secondary dropdown-toggle" href="{{route('email_cadences.white_labelled')}}" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            White-labelled Partners
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{route('email_cadences.direct_client')}}">Direct Clients</a>
            <a class="dropdown-item" href="{{route('email_cadences.technology')}}">Technology Partners </a>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-body document-text" id="coding_standards">
                <div id="heading1" class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">White-labelled Partners</h1>
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

                                    <li><b>Option 1:</b> Hoping to help</li>
                                    <li><b>Option 2:</b> I found you through (LinkedIn/placeholder)</li>
                                    <li><b>Option 3:</b> Did you get what you were looking for?</li>
                                </ul>

                                <p><b>Body:</b></p>

                                <p>Hi [name]</p>

                                <p>Because I work with Zaigo Infotech I constantly look for companies who can benefit from the custom software development services that we offer. I recently came across your profile on (LinkedIn) and felt you might be up for a brainstorming session with us. </p>

                                <p>I believe, for a business like yours, it’s critical to capitalize on technically adept and commercially viable white-labeled software products built by an extended team like ours, that hold both skillset and are reliable. </p>

                                <p>Companies like CGR Creative, Webnet Marketing, First Batch Hospitality, K2M creative have leveraged our White-labeling services to build intuitive solutions for their customers and have made the most out of it. </p>

                                <p>As we also come with a consultative nature we spend time with your people and ensure what we develop reflects what you care about, be it a Web, Mobile, SaaS application, or even legacy product migration for that matter. Our 98% customer retention rate speaks for itself and our experience from working with 100+ customers has gained us a structured approach to follow, 100% adherence to timely project delivery, and more. </p>

                                <p>If you are interested, I am happy to set up a quick call for us to discuss further. How does [Time & Date Options] look on your calendar?</p>

                                <p>Regards<br>
                                    [rep’s name]</p>

                                <p>P.S. If you’re not the right person to speak with, who do you recommend I talk to?</p>

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

                                    <li><b>Option 1:</b> Let’s take another look</li>
                                    <li><b>Option 2:</b> (day, time) works? </li>
                                    <li><b>Option 3:</b> Re: I found you through (LinkedIn/placeholder)</li>
                                </ul>

                                <p><b>Body:</b></p>

                                <p>Hi there,</p>

                                <p>I am [rep’s name] with Zaigo Infotech. Not sure if my previous email seemed like an ‘educated stab’ in the dark. I apologize if I had caught you at the wrong time.</p>
                                <p>I reached out to you only because I was confident that we could add value to your business.</p>
                                <p>Are white-labeling services a priority for your business right now? If so, may I propose a short email exchange or a phone call—to discuss your specific business needs and how we can fulfill them? </p>
                                <p>Some companies similar to you have successfully built a repeatable, scalable, and profitable business model as the result of partnering with us. They utilized our white-labeling services and built impacting solutions for their customers. I would love for you to succeed the same way.</p>

                                <p>Please let me know what you decide, (name of the receiver)?</p>

                                <p>Regards<br>
                                    [rep’s name]</p>
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
                                <p><b>Subject:</b></p>

                                <ul>
                                    <li><b>Option 1:</b> The audacity of this email!</li>
                                    <li><b>Option 2:</b> Here’s what I’ll do...</li>
                                    <li><b>Option 3:</b> Would anything change your mind?</li>
                                </ul>

                                <p><b>Body:</b></p>
                                <p>Hello [prospect’s name],</p>
                                <p>Just bumping this up in your inbox. </p>
                                <p>As I’d mentioned in my previous email, I truly believe that our partnership can go a long way and help you benefit from our white-labeling services, just like we’d great success working with teams like CGR Creative, Webnet Marketing, First Batch Hospitality, and K2M creative.</p>
                                <p>I'd love the opportunity to share our customer stories and a few of my partnership ideas with you over a brief call. Are you free this (day)or (day)? If so, feel free to book some time on my calendar: (insert calendar link) or you can share a couple of dates that work for you too. </p>
                                <p>Awaiting your response. </p>

                                <p>Thanks<br>
                                    (rep’s name)</p>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Email After Voicemail
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
                                    <li><b>Option 1:</b> Let’s try this again</li>
                                    <li><b>Option 2:</b> Is there a convenient time to talk to you?</li>
                                    <li><b>Option 3:</b> Just left you a voicemail</li>
                                </ul>

                                <p><b>Body: </b></p>
                                <p>Hi (prospect’s first name),</p>

                                <p>I just got off leaving you a voicemail but wanted to send in an email too in case you prefer this over a phone call.</p>

                                <p>I have been following your company updates, great action there! I quickly figured that our white-labeling services are a perfect alignment with your business.</p>

                                <p>My folks at Zaigo Infotech are passionate developers who come with abundant experience in building well-functioning software and applications. With white-labeling services, we have added value to companies like CGR Creative, Webnet Marketing, First Batch Hospitality, K2M creative, and many others.</p>

                                <p>We sit and spend time with our clients understanding their particular business needs, and then build for them personalized white-label services. We have a 98% customer retention rate which serves as proof of how efficient our approach is.</p>

                                <p>I’d love to connect and discuss your current needs. You may call me on my number (number) if convenient, or feel free to reply here.</p>

                                <p>Best,<br>
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
                                    <li><b>Option 1:</b> Dropped you a voicemail </li>
                                    <li><b>Option 2:</b> Is there a convenient time to talk to you?</li>
                                    <li><b>Option 3:</b> Would you like this?</li>
                                </ul>
                                <p><b>Body:</b></p>

                                <p>Hi (First Name),</p>

                                <p>I tried reaching you without success and left a voicemail. I went through your profile and our white-labeling services fit your business needs very well. </p>

                                <p>Hence, I wanted to share some of our customer success stories and a few tips about how you can leverage our white-labeling services and build A-class solutions for your digitally transforming customers.</p>

                                <p>With your permission, I’ll give you a call back on (date and time) for further discussion. Will that work?</p>

                                <p>Regards,<br>
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
                                    <li> <b>Option 1:</b> Let's have a 15 min call on this? </li>
                                    <li> <b>Option 2:</b> Are you up for a discussion?</li>
                                    <li> <b>Option 3:</b> Here’s the information you requested</li>
                                </ul>
                                <p><b>Body:</b></p>

                                <p>Hi (Name),</p>

                                <p>Thank you for the short call last time. </p>

                                <p>I’ve attached additional information to this email regarding our services and customer success stories for you to look at and gain trust in us. </p>

                                <p>I am working on a personalized offering that could benefit you and your team by solving all the pain points related to white-labeling services and also working with an outsourced team that is flexible, diverse, and accredited for building the best software solutions.</p>

                                <p>When can we schedule a follow-up conversation so we can dive into the details of the opportunity and partnership?</p>

                                <p>I look forward to hearing from you.</p>

                                <p>Thanks,<br>
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
                                <p><b>Subject</b></p>
                                <ul>
                                    <li><b>Option 1:</b> I'd love a quick call</li>
                                    <li> <b>Option 2:</b> Are you ready for a follow-up?</li>
                                    <li> <b>Option 3:</b> Good news! I have that info you requested </li>
                                </ul>
                                <p><b>Body:</b></p>

                                <p>Hi ( name),</p>
                                <p>I trust that you have had an opportunity to read my previous email and look at the documents I’d shared, so I figured it’d be worth checking in with you again.</p>
                                <p>If not, I’m sending you information again about our services and (x). From my experience at Zaigo Infotech, I know that choosing the right team who can internalize your business needs and build you a white-labelled service is one of the many difficult tasks. </p>
                                <p>At Zaigo Infotech we have worked with 100+ companies to overcome this issue. I believe we could help (contact’s company name) do the same.</p>
                                <p>Would you be interested in a call to discuss your company’s needs in-depth? If so, would [date, time] work for you?</p>
                                <p>I look forward to hearing from you.</p>
                                <p>Best,<br>
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
                                    <li> <b>Option 1:</b> Discussing your future goals today</li>
                                    <li> <b>Option 2:</b> Are you ready for the next step?</li>
                                    <li> <b>Option 3:</b> Here’s the information you requested</li>
                                </ul>
                                <p><b>Body:</b></p>

                                <p>Hi (Name),</p>

                                <p>Thank you for taking the time for chatting with me (yesterday). I appreciated hearing about the pain points your team faces regarding the white-labeling services and also working with an outsourced team; it certainly has helped me think of a personalized service that best fits your current need.</p>

                                <p>I’ve attached additional information to this email regarding our services and customer success stories for you to look at and gain trust in us. </p>

                                <p>When can we schedule a follow-up conversation with our team so we can dive into the details of thethis projectopportunity and partnership?</p>

                                <p>I look forward to hearing from you.</p>

                                <p>Thanks,<br>
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
                                    <li> <b>Option 1:</b> I'd love your feedback on that meeting</li>
                                    <li> <b>Option 2:</b> I thought about what you said</li>
                                    <li> <b>Option 3:</b> Here’s the information you requested</li>
                                </ul>
                                <p><b>Body:</b></p>

                                <p>Hi ( name),</p>
                                <p>I enjoyed talking with you (yesterday) and appreciate your interest in Zaigo Infotech.</p>
                                <p>As promised, I’m sending you additional information about our services and (x). From my experience at Zaigo Infotech, I know that choosing the right team who can internalize your business need and build you a white-labelled service is one of the many difficult tasks. </p>
                                <p>At Zaigo Infotech we have worked with 100+ X number of companies to overcome this issue. I believe we could help (contact’s company name) do the same.</p>
                                <p>Would you be interested in a call to discuss your company’s needs in-depth? If so, would [date, time] work for you?</p>
                                <p>I look forward to hearing from you.</p>
                                <p>Best,<br>
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