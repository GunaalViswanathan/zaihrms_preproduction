@extends('larasnap::layouts.app', ['class' => 'document-index'])
@section('title','document List')
@section('content')
<div class="documentation">
  <ul>
    <li><a href="{{route('document.index')}}">Coding Best Practices</a></li>
    <li><a href="{{route('document.qa_process')}}">QA Process</a></li>
    <li><a href="">SaaS Tech Stack</a></li>
    <li><a href="{{route('document.backup')}}">Backup Process</a></li>

  </ul>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">SaaS Tech Stack</h1>
</div>
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body document-text">
          <h3>Introduction</h3>
          <p>
          Software as a service (SaaS) is a software distribution model in which a cloud provider hosts applications and makes them available to end users over the internet. In this model, an independent software vendor (ISV) may contract a third-party cloud provider to host the application. 
        </p>
        <p>
          SaaS is one of three main categories of cloud computing, alongside infrastructure as a service (IaaS) and platform as a service (PaaS). A range of IT professionals, business users and personal users use SaaS applications. Products range from personal entertainment, such as Netflix, to advanced IT tools. 
        </p>
        
        <p>
          SaaS works through the cloud delivery model. A software provider will either host the application and related data using its own servers, databases, networking and computing resources, or it may be an ISV that contracts a cloud provider to host the application in the provider's data centre. The application will be accessible to any device with a network connection. SaaS applications are typically accessed via web browsers.
        </p>
        
          <div id="accordion" class="myaccordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          Technology Stack
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
          Technology stack is combination of programming languages, development tools, libraries, frameworks and software used to develop web or mobile application. This is one of the primary elements of development process.
        </p>
        <p>
          Technology stack is divided into two sides as “Front end” and “Back end”.
        </p>
        <p>
          Front end or client side of the application refers to user’s screen and interacting with the application. The front-end technologies include HTML, JS, CSS, UI frameworks and libraries. 
        </p>
        <p>
          Server side is a background operation which uses frameworks, programming languages, servers, operating systems and database.
        </p>
        <p>
          Technology stack determine application’s scalability, functionality and viability. This tech stack approach should allow to remain agile, simplify development maintenance and optimize costs. 
        </p>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Programming Language
          <span class="fa-stack fa-2x">
            <i class="fas fa-circle fa-stack-2x"></i>
            <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
          </span>
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <p style="font-weight: bold;">Python</p>
        <ul>
          <li>World’s fasted growing language</li>
        <li>Used for different tasks like data analysis, artificial intelligence, machine learning, web and mobile applications</li>
        <li>De-facto solution for the application which requires lot of backend logic, high computing algorithms, statistics, data science and high-performance REST APIs</li>
        <li>Advantages
          <ul>
            <li>Strong ecosystem, libraries and framework</li>
            <li>Few lines of code compared to other language</li>
            <li>MI and AL frameworks</li>
          </ul>
        </li>

        <li>Python framework
          <ul>
            <li>Django</li>
            <li>Flask</li>
          </ul>
        </li>
        </ul>
      </div>
      <div class="card-body">
        <p style="font-weight: bold;">Node.js</p>
        <p style="margin-left: 25px;">Node.js comes with several powerful web frameworks that are suitable for SaaS project. </p>
        <ul>
          <li>Express is the most powerful framework used for web and mobile application</li>
        <li>KOA is smaller and more expressive.</li>
        <li>Sails is web framework for Node.js that supports faster development and put emphasis on reliability</li>
        <li>Meteor is flexible tool aiming for ease-of-use functions as both front-end and back-end framework</li>
        <p></p>
        <p>Many websites render on the client side. Can send pre-rendered views to the user, speeding up loading times and giving a smooth experience. Node.js is suitable for SaaS platform for a busy environment. Node.js is suitable for building complex web application and helps in not bloating the team.</p>
        <p>Node.js is suitable and perfect for search engine optimization as pre-rendered data is delivered to the browser. </p>
        </ul>
      </div>
      <div class="card-body">
        <p style="font-weight: bold;">PHP</p>

        <p>Laravel PHP framework is the best for back-end application development. Laravel framework is used for web development backend. This completely depends on the Model View Controller (MVC). This takes a fast development approach to create high quality web applications with modular programming.  This is suitable for development of web applications, including web services, web resources, and web APIs.  </p>
        
      </div>
      <div class="card-body">
        <p style="font-weight: bold;">React JS</p>

        <p>React is one of the common platforms used in many startups, fintech and SaaS companies. Around 60% of the company uses React for front end development. This is suitable for social networks, e-commerce sites, landing pages, dashboards and front-end UI websites.  </p>
        <p></p>
        <p>React is mainly processed in the client side leaving all computing to the end user. This provides a virtual DOM which facilitates the update of components and views without the need to update the whole “view”. </p>
         <p></p>
          <p>This also provides a development environment for hybrid mobile platform. </p>
          <p></p>
          <p>The complete development happens as components and re-use the features or functionalities. </p>
          <p></p>
          <p>Note:<i style="color:#3c8dbc"> The other possible front-end frameworks are “Angular JS”, “Vue JS” or “JQuery”. Not elaborating more on these frameworks in this document. The other possible way of building client-side framework is to use the complete features of HTML5, CSS3 and Javascript.</i> </p>
        
        
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Cloud Providers
          <span class="fa-stack fa-2x">
            <i class="fas fa-circle fa-stack-2x"></i>
            <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
          </span>
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        <p style="font-weight: bold;">Amazon Web Services</p>
        <p>AWS has been a leader in the market for 13 years and provide a more mature cloud service ecosystem than the rest. All communities and niches use AWS.  Most of the fintech, bank or software company, they are using 70% of the time.  The various revolutionized services are Amazon S3 in 2007, EC2 instances, Amazon ECS and serverless ecosystem with Amazon Lambda.</p>
         <p style="font-weight: bold;">Azure</p>
        <p>If the application is windows based, Azure is a suitable environment.</p>
        <p><b>Google Cloud Platform (GCP)</b></p>
        <p>This is suitable for environments like free credits or big data solutions.</p>
                
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingFour">
      <h2 class="mb-0">
        <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
          Server Development Types
          <span class="fa-stack fa-2x">
            <i class="fas fa-circle fa-stack-2x"></i>
            <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
          </span>
        </button>
      </h2>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
      <div class="card-body">
        <p style="font-weight: bold;">Monolithic</p>
         <p>This is a pure unit system deployed together and can’t be de-coupled or decomposed into pieces of software (modules). This model of building applications is obsolete.</p>

         <p style="font-weight: bold;">Microservice</p>
         <p>This is an architectural ecosystem where you have independent services. Each of the services has a well-defined role (API, database, backend, cache, etc..) and can be independently developed, deployed and tested.  This also provides an additional advantage of leveraging multiple programming-languages and platforms in the same ecosystem. </p>

         <p style="font-weight: bold;">Docker</p>
         <p>Docker is one of the essential tools for running containers in Linux, MAC of windows platforms. It is a platform that virtualizes and separate containers, fully isolated from one to another and packaged with their own software, libraries and operating system. Docker can logically label and split every container as one server, one app and one operating system. Container usually takes 1-3 seconds to load which is a time-consuming model comparing to loading a physical or virtual server.</p>

         <p style="font-weight: bold;">Advantages of Microservices</p>
         <ul>
           <li>Faster software development for your SaaS application.</li>
           <li>By decoupling (splitting) application into microservices, uses fewer resources and reduce hosting costs.</li>
           <li>It gives the ability to work on independent services where each developer can develop in parallel.</li>
           <li>Enables to troubleshoot independent services and reduce the point-of-failure.</li>
           <li>SaaS Services can scale independently. API, shopping cart, payment gateway, backend, database, etc.</li>
           <li>Microservices can use different technology stacks, and this brings flexibility. You could be running python 3.7 in your microservice architecture and a PHP application with PHP 7.0 version, totally independent and flexible. </li>
           <li>Containers make it easy to launch a local dev environment. “Docker up,” and you are ready to develop your SaaS product.</li>
           <li>Microservices helps with the 12-factor methodology about the parity between dev, test, and production. The ability to standardize production environments.</li>
           <img align="center" src="{{storageUrl('public/document/fourth_file.jpg')}}" alt="Girl in a jacket" style="margin-left:150px" width="70%" height="30%">
         </ul>
         <p style="font-weight: bold;">Microservice Clustering System</p>
         <p>For scaling up, orchestration system to manage microservices and containers that allows to scale and grow SaaS application. The options can be “Amazon ECS” or “Fargate” or “Amazon EKS (Kubernetes)”.</p>
         <p style="font-weight: bold;">Container Orchestration Tools</p>
         <ol>
           <li><b>Amazon ECS.</b> It is the natural Amazon container orchestration system in the AWS ecosystem. (Highly recommended for startups, small SaaS, and medium SaaS).</li>
           <li><b>Amazon Fargate.</b> Almost Serverless, price, and management is per task. Minimal operational effort vs. ECS. In terms of performance, Fargate can be slower than ECS</li>
           <li><b>Amazon EKS (Kubernetes).</b> It is a managed service that makes Kubernetes on AWS easy to manage. Use Amazon EKS instead of deploying a Kubernetes cluster on an EC2 instance, set up the Kubernetes networking and worker nodes.</li>
         </ol>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingFive">
      <h2 class="mb-0">
        <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
          Multi-tenant architecture
          <span class="fa-stack fa-2x">
            <i class="fas fa-circle fa-stack-2x"></i>
            <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
          </span>
        </button>
      </h2>
    </div>
    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
      <div class="card-body">
        <p>Multi-tenant architecture is a software architecture that allows to run multiple single software instances on a single application system. Each instance is a tenant application coming from the same software architecture.  A tenant is called an organization and multi-tenancy is a term for this same architecture. As a result, multiple tenants share the same memory, CPU, code, software, and hardware resources but are logically isolated, dynamically allocated, and cleaned up as needed.</p>

        <p style="font-weight: bold;">Advantages</p>
        <p style="font-weight: bold;">Single Codebase</p>
        <p>One single source code of trust, instead of getting concurrently code repositories per each tenant or organization, now with this approach you have a single repository for the entire SaaS product, which will bring agility, and less maintenance and complexity.</p>

        <p style="font-weight: bold;">Innovation speed</p>
        <p>The ability to maintain one repository and a single codebase, as a consequence, allows you to innovate faster and improve development productivity.</p>

        <p style="font-weight: bold;">Microservices and serverless adoption</p>
        <p>Adopting a precise multi-tenant architecture strategy allows to leverage modern enterprise cloud-native ecosystems, including Docker, containers, microservices, and Kubernetes – the top DevOps and cloud-native trends for the next years.</p>

        <p style="font-weight: bold;">Automation</p>
        <p>Adopting a multi-tenant approach allows to automatically bring new tenants, clean-up tenant subscribers that are not within the SaaS, and reduce maintenance costs.</p>
     
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingSix">
      <h2 class="mb-0">
        <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseThree">
          Database Software
          <span class="fa-stack fa-2x">
            <i class="fas fa-circle fa-stack-2x"></i>
            <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
          </span>
        </button>
      </h2>
    </div>
    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
      <div class="card-body">
        <ul>
          <li>Amazon DynamoDB</li>
          <li>Amazon RDS with Postgresql</li>
          <li>Mongo DB</li>
          <li>MySQL</li>
          <li>PostgreSQL</li>
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
  box-shadow: 0 0 1px rgba(0,0,0,0.3);
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

.myaccordion li + li {
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



