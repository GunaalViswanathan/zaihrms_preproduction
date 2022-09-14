@extends('larasnap::layouts.app', ['class' => 'project-index'])
@section('title','Leave Policy')
@section('content')
<!-- Page Heading  Start-->
<div id="heading1" class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Leave Policy</h1>
</div>
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body document-text" id="coding_standards">
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <td style="text-align:center; background-color: #bcdaf3" colspan="4"><b>Zaigo Leave Policy – October 2021</b></td>
                  </tr>
                  <tr>
                     <th scope="col" style="text-align:center;">S.No</th>
                     <th scope="col" style="text-align:center;">Leave Type</th>
                     <th scope="col" style="text-align:center;">Details</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <th style="text-align:center; width:10%" scope="row">1</th>
                     <td style="text-align:center; width:30%"><b>Casual Leave -CL</b></td>
                     <td style=" width:60%">
                        <ul>
                           <li>
                           	12 Days in a year (January to December)
                           </li>
                           <li>
                           	Can avail 1 day per month for any urgent / unforeseen personal needs
                           </li>
                           <li>
                           	Leave not applicable for employees joined after 15th of any month
                           </li>
                           <li>
                           	Casual Leave not availed for a month will be accumulated and it can be used within the same calendar year
                           </li>
                           <li>
                           	Employees can avail one advanced casual leave in a month <br><i style="color:blue;">(For ex: For month of January, an employee can take 2 days casual leave of which one advance casual leave of February will be used)</i>
                           </li>
                           <li>
                           	Employees who have accumulated casual leaves within the calendar year can use all the leaves whenever required
                           </li>
                           <li>
                           	If an employee takes a leave continuously which has holidays in between, then total number of days will be calculated including those holidays <br><i style="color:blue;">(For ex: if employee avails leave on Friday and Monday, then the total number of days calculated will be 4)</i>
                           </li>
                           <li>
                           	Only 3 Casual leaves can be availed by an employee within the month
                           </li>
                           <li>
                           	For availing leave an employee have to intimate respective manager and apply leave through HRMS portal and get the approval for the same. If not, it will be considered as LOP. Manager has to provide an approval for his / her team members
                           </li>
                           <li>
                           	CL will not be carry forwarded to next calendar year
                           </li>
                        </ul>
                     </td>
                     
                  </tr>
                  <tr>
                     <th style="text-align:center; width:10%" scope="row">2</th>
                     <td style="text-align:center; width:30%" ><b>Sick Leave - SL </b></td>
                     <td style="width:60%">
                        <ul>
                           <li>
                           	6 days in a year
                           </li>
                           <li>
                           	Can avail 3 or more continuous days (maximum of 6) for any health-related issues
                           </li>
                           <li>
                           	Medical Certificate or doctor prescription mandatory for availing this leave
                           </li>
                           <li>
                           	The certificate or prescription should be submitted to HR on the same day when reporting back to office from medical leave
                           </li>
                           <li>
                           	SL will be eligible for the employees who are confirmed. During the probation period SL is not allowed.
                           </li>
                           <li>
                           	For availing leave an employee have to intimate respective manager. Apply for sick leave through HRMS once reported back to office. If not, it will be considered as LOP. Manager has to provide an approval for his / her team members
                           </li>
                           <li>
                           	SL will not be carry forwarded to next calendar year.
                           </li>
                        </ul>
                     </td>
                  </tr>
                  <tr>
                     <th style="text-align:center; width:10%" scope="row">3</th>
                     <td style="text-align:center; width:30%"><b>Privilege Leave - PL</b></td>
                     <td style="width:60%">
                        <ul>
                           <li>
                           	12 days in a year
                           </li>
                           <li>
                           	After completing one full calendar year an employee is eligible for Privilege leave. Privilege leaves will be on a pro-rata basis <br><i style='color:blue;';>(Ex: If an Employee avails 10 PL in first three months and then resigns, he/she may have to pay for the excess leaves taken)</i>
                           </li>
                           <li>
                           	For more than 3 or more days leave, an employee can avail PL. (For any emergency if all available CLs are used in the current month & employee want to avail 1 additional leave, then it will be treated as 3 PL)
                           </li>
                           <li>
                           	In case of long leave for more than 3 days an employee has to get the approval from the second level manager (CEO / CTO).
                           </li>
                           <li>
                           	PL will be carry forwarded for next year. <br><i style="color:blue;"> (Ex. If an employee avails 5 PL in current calendar year & remaining 7 PL will be carry forwarded to next calendar year. In next calendar year total PL will be 19 Days)</i>
                           </li>
                           <li>
                           	For availing leave an employee have to intimate respective manager and apply leave through HRMS portal. If not, it will be considered as LOP. 
                           </li>
                           <li>
                           	Maximum Earned leaves that can be accumulated is only 24
                           </li>
                        </ul>
                     </td>
                  </tr>
                  <tr>
                     <th style="text-align:center; width:10%" scope="row">4</th>
                     <td style="text-align:center; width:30%"><b>Marriage Leave</b></td>
                     <td style="width:60%">
                        <ul>
                           <li>
                           	14 days for wedding of an employee
                           </li>
                           <li>
                           	If an employee wants to avail a leave for wedding, he/she may have to submit wedding invitation to HR for documentation
                           </li>
                           <li>
                           	Employee have to intimate to respective manager and second level manager before one month for availing marriage leave
                           </li>
                           <li>
                           	For availing leave an employee have to intimate respective manager and apply leave through HRMS and get the approval for the same. If not, it will be considered as LOP.
                           </li>
                        </ul>
                     </td>
                  </tr>
                  <tr>
                     <th style="text-align:center; width:10%" scope="row">5</th>
                     <td style="text-align:center; width:30%"><b>Maternity Leave - ML</b></td>
                     <td style="width:60%">
                        <ul>
                           <li>
                           	26 weeks for maternity leave for 2 children
                           </li>
                           <li>
                           	For eligibility an employee should have completed working for at least 3 months 
                          </li>
                           <li>
                           	For the 3rd child 12 weeks is permitted
                           </li>
                           <li>
                           	In case of miscarriage, an employee has to submit the proof and can avail leaves for 6 weeks immediately after miscarriage
                           </li>
                           <li>
                           	This leave is paid leave as per government norms 
                           </li>
                        </ul>
                     </td>
                  </tr>
                  <tr>
                     <th style="text-align:center; width:10%" scope="row">6</th>
                     <td style="text-align:center; width:30%"><b>Compensatory Off - CO</b></td>
                     <td style="width:60%">
                        <ul>
                           <li>
                           	An employee can claim for compensation leave after having worked on a holiday
                           </li>
                           <li>
                           	Manager has to provide an approval and send a mail to HR 
                          </li>
                           <li>
                           	CO can be utilised within 8 weeks from the date of approval of compensatory off. Post 8 weeks, it will be lapsed. 
                           </li>
                           
                        </ul>
                     </td>
                  </tr>
                  <tr>
                     <th style="text-align:center; width:10%" scope="row">7</th>
                     <td style="text-align:center; width:30%"><b>Loss of Pay - LOP</b></td>
                     <td style="width:60%">
                        <ul>
                           <li>
                           	If an employee exhausted all eligible leaves, then it will be calculated as LOP
                           </li>
                           <li>
                           	Taking leaves without informing respective manager / HR will be considered as LOP
                          </li>
                        </ul>
                     </td>
                  </tr>
                  <tr>
                     <th style="text-align:center; width:10%" scope="row">8</th>
                     <td style="text-align:center; width:30%"><b>Permission - PR</b></td>
                     <td style="width:60%">
                        <ul>
                           <li>
                           	2 Permissions are allowed in a month and each permission cannot exceed 2 hours
                           </li>
                           <li>
                           	The permission should be continuous hours
                           </li>
                           <li>
                           	For permissions, an employee has to inform the manager before availing permission and in worse case situation should apply for permission and get the approval immediately after reporting to office
                           </li>
                        </ul>
                     </td>
                  </tr>
                  
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@endsection