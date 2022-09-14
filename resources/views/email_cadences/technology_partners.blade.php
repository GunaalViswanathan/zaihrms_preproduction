@extends('larasnap::layouts.app', ['class' => 'document-index'])
@section('title','Email Cadences')
@section('content')
<div id="heading1" class="d-sm-flex align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Customer Type</h1>
    <div class="dropdown show ml-2">

        <a class="btn btn-secondary dropdown-toggle" href="{{route('email_cadences.technology')}}" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Technology Partners
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{route('email_cadences.direct_client')}}">Direct Clients</a>
            <a class="dropdown-item" href="{{route('email_cadences.white_labelled')}}">White-labelled Partners </a>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-body document-text" id="coding_standards">
                <div id="heading1" class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Technology Partners</h1>
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
                                    <li><b>Option 1:</b> Do you have this in mind?</li>
                                    <li><b>Option 2:</b>Read this email tomorrow</li>
                                    <li><b>Option 3:</b> Did you know that you can get superpowers?</li>
                                </ul>
                                <p><b>Body:</b></p>

                                <p>Hi [name]</p>

                                <p>I just found you on (Linkedin/google/Twitter/placeholder) and wanted to personally reach out to you and see if you’d like to partner with us. Usually, I do this, whenever I find companies like yours that are so good at offering tech products that can benefit from our integration and technology support capabilities.</p>

                                <p>I thought you might be interested in finding out how we helped companies like yours by partnering with them to build extended product integrations into their existing ecosystem that were primarily designed to drive desired results for their businesses.</p>

                                <p><b>Quick intro:</b> I am [rep’s name] with Zaigo Infotech. We are named for building A-class Web and Mobile applications, SaaS applications, Mobile and Software development, performing legacy software migration, providing integration services for software OEMs, and several other services.</p>

                                <p>Well, how does (date, date, date) of (month) look on your calendar to discuss further? Also, here's a link to my calendar, or please feel free to send me yours.</p>

                                <p>Regards<br>
                                    [rep’s name]</p>

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
                                    <li><b>Option 1:</b> 15 minutes of your time? </li>
                                    <li><b>Option 2:</b>Want to discuss technology partnership strategy? </li>
                                    <li><b>Option 3:</b> We’ve got some partnership plans for you</li>
                                </ul>
                                <p><b>Body:</b></p>

                                <p>Hi [name]</p>

                                <p>The optimist in me refuses to stop until I get to speak with you.</p>

                                <p>I am (rep’s name) from Zaigo Infotech and at Zaigo we build solutions like Web and Mobile applications, SaaS applications, Software development, extended product integrations into a business’s existing tech ecosystem, and much more for businesses to digitally transform and scale. </p>

                                <p>We have had incredible success with a number of our partners who build intuitive tech products, as we partnered with them and enabled their products with integration and technology support capabilities.</p>

                                <p>I was thinking if we can get on a short call on (day) at (time), (receiver’s name)?</p>

                                <p>If this isn’t your does not lie in your domain, my apologies. It would be amazing if you could point me in the right direction.</p>

                                <p>Thanks<br>
                                    (rep’s name)</p>

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
                                    <li><b>Option 1:</b> (prospect’s name), open to this? </li>
                                    <li><b>Option 2:</b>Any updates on this?</li>
                                    <li><b>Option 3:</b> I forgot to mention...</li>
                                </ul>
                                <p><b>Body:</b></p>

                                <p>Hi (name),</p>

                                <p>How are you? I sent you a couple of emails a while ago about Zaigo Infotech and how I think we could be a great addition to your business. </p>

                                <p>We have to tell you! After partnering with us a slew of our clients report an X15% increase in their sales numbers. As a team, we are extremely flexible and have the skill set to work with any type of software EOMs catering to a wide range of businesses. </p>

                                <p>I will happily spend 30 mins sharing about our technology partnerships experiences and how we can benefit your business over a call maybe. </p>

                                <p>I look forward to your response.</p>

                                <p>Thanks<br>
                                    (rep’s signature)</p>

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
                                    <li><b>Option 1:</b> Did you get my voicemail? </li>
                                    <li><b>Option 2:</b>Are you around? </li>
                                    <li><b>Option 3:</b>When shall we connect next?</li>
                                </ul>
                                <p><b>Body:</b></p>
                                <p>Hello, (Name),</p>

                                <p>Unfortunately, I couldn’t get in touch with you on the phone earlier today. I was calling to discuss if you have an ongoing need for technology partners who can help expand your software capabilities by building extended product integrations for your existing ecosystem. </p>

                                <p>However, the voicemail told me to try reaching you again on (enter the date/time). Till I do, you can contact me here or at (insert a cell number).</p>

                                <p>Best,<br>
                                    (rep’s signature)</p>


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
                                    <li><b>Option 1:</b> Should I stay or should I go? </li>
                                    <li><b>Option 2:</b>I’m sure this will change your mind </li>
                                    <li><b>Option 3:</b>Hey, (prospect’s name)</li>
                                </ul>
                                <p><b>Body:</b></p>

                                <p>Hi (name),</p>

                                <p>How is it going? I just left you a voicemail and I know I haven’t heard back from you yet but I’d like to provide some assistance. Just thought I’d give you a quick peek into what we do at Zaigo Infotech and allow you to decide then on. </p>

                                <p>We are a company helping businesses scale by partnering and building for them extended product integrations for their existing ecosystem, primarily designed to drive outcomes and ROI. </p>

                                <p>We also build winning Web and Mobile applications, SaaS applications, Mobile and Software development, and offer several other personalized services.

                                </p>

                                <p>I was hoping to schedule a brief conversation to discuss your current business positions and how Zaigo could help (lead’s company name) grow. How are you placed next week?</p>

                                <p>Best,<br>
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
                                    <li><b>Option 1:</b> As promised, here is more info about...</li>
                                    <li><b>Option 2:</b>Can we chat sometime soon? </li>
                                    <li><b>Option 3:</b>The information I promised </li>
                                </ul>
                                <p><b>Body:</b></p>

                                <p>Hi (name),</p>

                                <p>Thanks so much for the quick chat earlier today! </p>

                                <p>I reached out because I think there's a definite potential for us to help you boost your business with our tech partnerships offerings.</p>


                                <p>If you’re interested, I can schedule a call to discuss our services further in detail and places where our integration capabilities can fit into your existing ecosystem of products. We take pride in how many of our partners have had a minimum of 15% increase in their sales numbers after leveraging our services.</p>

                                <p>Also, have to admit that our team is extremely flexible and has the skill set to work with any type of software OEMs and those who are catering to a wide range of businesses. </p>

                                <p>Please let me know if you would like to move forward.</p>

                                <p>Best,<br>
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
                                    <li><b>Option 1:</b> (prospect’s name), your thoughts? </li>
                                    <li><b>Option 2:</b>Was great chatting with you, (name) </li>
                                    <li><b>Option 3:</b>Ready to continue our discussion? </li>
                                </ul>
                                <p><b>Body:</b></p>

                                <p>Hi (prospect’s name),</p>

                                <p>Circling back to see if you had the chance to look at my previous email. </p>

                                <p>I’d sent you the documents – as well as a meeting request and I’m looking forward to our next conversation. </p>


                                <p>If you have any questions before we speak, please don’t hesitate to call me back on my direct dial phone number: (Your number).</p>

                                <p>Once again, thank you for your time earlier and I’II look forward to continuing our conversation next week.</p>



                                <p>Thanks,<br>
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
                                    <li><b>Option 1:</b> (prospect’s name), your thoughts? </li>
                                    <li><b>Option 2:</b>Was great chatting with you, (name) </li>
                                    <li><b>Option 3:</b>Ready to continue our discussion? </li>
                                </ul>
                                <p><b>Body:</b></p>

                                <p>Hi (prospect’s name),</p>

                                <p>Thank you for taking your time today to tell me a little about your company and what you are trying to accomplish. It sounds like we can help you with critical technology partnerships that you require to scale your product capability. </p>

                                <p>I’ve sent you the documents – as well as a meeting request and look forward to our next conversation (confirm the time for the next contact).</p>


                                <p>If you have any questions before we speak, please don’t hesitate to call me back on my direct dial phone number: (Your number).</p>

                                <p>Once again, thank you for taking the time to speak with me, and I look forward to continuing our conversation next (week).</p>



                                <p>Thanks,<br>
                                    (rep’s signature)</p>

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
                                    <li><b>Option 1:</b>(prospect’s name), your thoughts? </li>
                                    <li><b>Option 2:</b>Was great chatting with you, (name) </li>
                                    <li><b>Option 3:</b>Ready to continue our discussion? </li>
                                </ul>
                                <p><b>Body:</b></p>

                                <p>Hi (prospect’s name),</p>

                                <p>Thank you for taking a few minutes today for a brief chat. </p>

                                <p>Well, I reached out to you after reading up on your company and as I felt we can help you with critical technology partnerships that you require to scale your product capability. </p>


                                <p>I’ve sent you the documents – as well as a meeting request and look forward to our next conversation (confirm the time for the next contact).</p>

                                <p>If you have any questions before we speak, please don’t hesitate to call me back on my direct dial phone number: (Your number).</p>
                                <p>Once again, thank you for your time earlier and I’II look forward to continuing our conversation next week.</p>



                                <p>Thanks,<br>
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