<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms & Conditions - Biman Bangladesh Airlines</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Outfit', sans-serif;
            background: url('images/back.jpeg') no-repeat center center fixed;
            background-size: cover;
        }

        .navbar {
            background-color: transparent;
            padding: 15px;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
        }

        .nav-link {
            color: white;
            font-weight: bold;
            margin-right: 20px;
        }

            .nav-link:hover {
                color: white;
            }

     
        .navbar-light .navbar-nav .nav-link {
            color: white; 
        }

            .navbar-light .navbar-nav .nav-link:hover {
                color: #097969; 
            }

        
        .center-container {
            display: flex;
            justify-content: center; 
            align-items: center; 
            height: 25vh;
        }

       
        .terms-box {
            padding: 10px 20px;
            border-radius: 25px; 
            background-color: white;
            font-size: 40px;
            font-weight: bold;
            color: #770737; 
            text-align: center;
        }

        .sidebar {
            position: sticky;
            top: 20px;
            left: 25px;
        }

        .content-section {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .footer {
            background-color: #004c99;
            color: white;
            text-align: center;
            padding: 2px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: bold;
        }
        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-item:hover {
            background-color: #343a40; 
            color: white; 
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/Biman_Bangladesh_Airlines_Logo.png" alt="Biman Bangladesh Airlines" width="300">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item" style="font-family: Poppins, sans-serif;">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item" style="font-family: Poppins, sans-serif;">
                        <a class="nav-link" href="destination.php">Destinations</a>
                    </li>
                    <li class="nav-item" style="font-family: Poppins, sans-serif;">
                        <a class="nav-link" href="contactus.php">Contact Us</a>
                    </li>
                    <li class="nav-item" style="font-family: Poppins, sans-serif;">
                        <a class="nav-link" href="termsCondition.php">Terms & Conditions</a>
                    </li>
                </ul>
                <!-- Profile Dropdown -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <img src="images/profile.png" alt="Profile" class="rounded-circle" width="40" height="40">
                        <div class="dropdown-menu" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="user.php">My Profile</a> <!-- Link to Profile -->
                            <a class="dropdown-item" href="login.php">Log Out</a> <!-- Log Out Link -->
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <!-- Centering Container -->
        <div class="center-container">
            <div class="terms-box">
                Terms & Conditions
            </div>
        </div>
        <div class="row">
            <!-- Sidebar Navigation inside a Card -->
            <aside class="col-md-3 col-lg-3 d-md-block sidebar">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" style="color: #770737; font-weight: 700; font-size: 22px">On This Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#general" style="color: #71797E; font-weight: 700;">General</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#conditions-of-enrollment" style="color: #71797E; font-weight: 700;">Conditions of Enrollment</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#membership-responsibility" style="color: #71797E; font-weight: 700;">Membership Responsibility</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#termination" style="color: #71797E; font-weight: 700;">Termination</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#accruals" style="color: #71797E; font-weight: 700;">Accruals</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#reward" style="color: #71797E; font-weight: 700;">Reward</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#upgrade" style="color: #71797E; font-weight: 700;">Upgrade</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#retain-tier-status" style="color: #71797E; font-weight: 700;">Retain Tier Status</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#data-protection" style="color: #71797E; font-weight: 700;">Data Protection</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#privacy" style="color: #71797E; font-weight: 700;">Privacy</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#definitions" style="color: #71797E; font-weight: 700;">Definitions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#account-deletion" style="color: #71797E; font-weight: 700;">Account Deletion</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-9 px-md-4">
                <div id="general" class="content-section">
                    <h4 style="margin-bottom: 20px; font-size: 30px; font-weight: bold; color: #770737;">General</h4>
                    <p>Biman Loyalty Club (BLC) is managed and operated by Biman Bangladesh Airlines Ltd. Participants in the program as individuals (hereinafter called Member) are subject to these Terms & Conditions, which may be changed by Biman Bangladesh Airlines Ltd. from time to time without prior notice and shall be deemed to constitute acceptance by the member of such Terms & Conditions as amended from time to time.</p>
                    <p>As a condition of use of this programme, a member agrees to indemnify Biman Bangladesh Airlines Ltd. from and against any and all liabilities, expenses (including legal fees), and damages arising out of claims resulting from members use of this website, including without limitation any claims alleging facts that, if true, would constitute a breach by a member of these terms and conditions.</p>
                    <p>Biman Bangladesh Airlines Ltd. may assign or deal with any of its designated agents, subsidiaries, or subcontractors as collateral for any obligation it may have under these terms and conditions. Biman Bangladesh Airlines Ltd. shall not be liable to its members for any delay or non-performance by subcontractors, Force Majeure Events, and/or agents for any cause beyond its reasonable control.</p>
                    <p>These terms and conditions set out the contractual relationship between Biman Bangladesh Airlines Ltd. and each individual member of the Biman Loyalty Club.</p>
                    <p>The application for membership in the Biman Loyalty Club is open to any individual who is at least two years of age. An applicant must fully complete the Biman Loyalty Club enrollment form and supply all required information in order to be eligible for membership. A corporation, firm, partnership, or other entity is not eligible to become a member.</p>
                    <p>Membership is accepted at the sole discretion of Biman Bangladesh Airlines Ltd. and is free of charge. Biman Loyalty Club will issue a Member with a digital membership number against which his or her Miles will be transacted. A Member will be able to access the digital membership card via the Biman Bangladesh Airlines Ltd. website after enrolment. A Member can either quote his or her membership number or present it via the Biman Bangladesh Airlines Ltd. website, email, or as a saved image on a portable device during travel on qualifying flights and at the time of paying for other qualifying goods or services.</p>
                    <p>Upon joining or upgrading to a tier within Biman Loyalty Club, members will receive a virtual membership card. Members can visit Biman Loyalty Club online membership regulation before enrolling.</p>
                    <p>The digital membership card provides members with the same level of benefits they use to receive while using the physical card. The digital membership card may state an expiry date and, if so, is only valid for use up to that expiry date. The digital membership card will also have a validity date for a members Membership Tier.</p>
                    <p>The digital membership card may only be used by the Member named on that card. A member name must be entered in English as it appears on a members passport. A digital membership card is not a credit card and is used for the purpose of identification only. A digital membership card is not transferable and at all times remains the property of the issuer. Membership of the Club and membership digital cards are not transferable and may only be used by the Member.</p>
                    <p>Biman Bangladesh Airlines Ltd. reserves the right to interpret, apply, and communicate the Terms & Conditions as posted on the website or any other printed materials. All decisions made by Biman Bangladesh Airlines shall be final and conclusive in each case.</p>
                    <p>Individual members are responsible for keeping their e-mail and mailing address up-to-date. Any communication sent to a member's registered email or address will be regarded as delivered when posted or emailed to the mailing address on record. Biman Bangladesh Airlines Ltd. will not be responsible for any delayed, misdirected, or lost mail. Any modifications to the Members profiles must be updated online or by corresponding with the Biman Loyalty Club along with legitimate proof of documents as required.</p>
                    <p>Biman Bangladesh Airlines Ltd. reserves the right to modify the Biman Loyalty Club structure, benefits, or other features, including these terms and conditions, or to terminate the Biman Loyalty Club at any time upon reasonable notice where possible, and Biman Bangladesh Airlines Ltd. will not be liable for any loss or damage resulting therefrom. Any use of the Biman Loyalty Club by a member will be deemed acceptance of any amendment to these terms and conditions.</p>
                    <p>The actual Biman Loyalty Club miles earned by a member are a percentage, based on class flown, of the categories used by the Biman Loyalty Club that are based on the Great Circle Distance in miles between origin airports and destination airports. For connecting flights that require a change of flight number, the sum of the Great Circle Distance of each segment will form the basis of the Biman Loyalty Club miles/sectors.</p>
                    <p>There is no minimum Biman Loyalty Club miles/sectors earned guarantee. Biman Loyalty Club miles/sectors earned are not affected by complimentary upgrades or involuntary downgrades. Only the member named on the Biman Loyalty Club digital card may use it. Cards are not transferable.</p>
                    <p>Miles are valid for two years from the date of transaction. Unused Biman Loyalty Club miles will expire at the end of the stated validity period.</p>
                    <p>Biman Loyalty Club reserves the right to cancel, suspend, or terminate a member's membership or accumulated miles at any time with or without prior notice. Any unused miles that are remaining in the account will be forfeited and cannot be used.</p>
                    <p>A Member may discontinue his or her membership at any time by requesting to Biman Loyalty Club. Membership of the Biman Loyalty Club Programme will terminate immediately on notification of death or bankruptcy of a Member. Any application submitted by or on behalf of a legal beneficiary for the deceased Members accumulated Miles must be accompanied by (i) a copy of the deceased Members death certificate; (ii) a copy of the deceased Members will or testament, court order or other satisfactory legal documentation demonstrating the legal beneficiarys entitlement to the accumulated Miles; and (iii) any other supporting documentation requested by Biman Loyalty Club.</p>
                </div>

                <div id="conditions-of-enrollment" class="content-section">
                    <h4 style="margin-bottom: 20px; font-size: 30px; font-weight: bold; color: #770737;">Conditions of Enrollment</h4>
                    <p>To become a member, you must enroll online by completing the Loyalty Club Enrollment Form. On successful enrollment, Members will be issued a membership number and digital membership card.</p>
                    <p>Membership enrollment is only open to individuals and is not available to companies, partnerships, unincorporated associations, or other entities.</p>
                    <p>Membership is not transferable. A Member is not permitted to hold more than one Account. All Miles and Rewards under the Biman Loyalty Club are accrued by or issued to a Member in his or her Member Account. If you have more than one Biman Loyalty Club account, your accounts will be merged, and miles will be transferred into one account.</p>
                    <p>Every enrollment has to have a unique e-mail address i.e. Two members within Biman Loyalty Club including children cannot use the same e-mail address.</p>
                    <p>Member should produce the Biman Loyalty Club digital card or Biman Loyalty Club number at any time whilst traveling or otherwise utilizing any services at the request of Biman Bangladesh Airlines Ltd. or a Biman Loyalty Club Partner.</p>
                    <p>Membership Account with missing information or incomplete personal details will be considered Pending Account and will be closed within 12 months from the date of enrollment.</p>
                    <p>Member should add his or her Biman Loyalty Club number at the time of booking or at prior check-in to ensure miles are credited automatically to their Biman Loyalty Club account.</p>
                    <p>Biman Bangladesh Airlines Ltd. and Biman Loyalty Club Partners have the right to require you to produce your Biman Loyalty Club card and quote your Biman Loyalty Club number at any time while booking, ticketing, traveling, or claiming a Reward.</p>
                    <p>Biman Bangladesh Airlines Ltd. shall not be liable to any member for any indirect or consequential loss, damage, or expense of any kind whatsoever arising out of or in connection with the Biman Loyalty Club and/or the use of or the unavailability of facilities of the Biman Loyalty Club and/or the provision or the refusal to provide any benefits, whether such loss, damage, or expense is caused by negligence or otherwise, and whether Biman Bangladesh Airlines Ltd. has any control over the circumstances giving rise to the claim or not.</p>
                    <p>In any event, subject to the above and any applicable limitation under the Warsaw Convention or under Biman Bangladesh Airlines Ltd's conditions of travel, the liability of Biman Bangladesh Airlines Ltd in contract, tort, or otherwise with respect to any claim arising in respect of acts or omissions in operating the Biman Loyalty Club shall be limited to the value of the ticket being used by the member in connection with which the matter.</p>
                    <p>Biman Bangladesh Airlines Ltd. will endeavor to ensure the availability of services of the Biman Loyalty Club when these are provided by partners but will not be liable for any loss arising from the failure by partners to provide such services. Where a member uses the services provided by partners, the partners' terms and conditions will apply and Biman Bangladesh Airlines Ltd. will not be liable for any loss.</p>
                    <p>Biman Bangladesh Airlines Ltd. confirms that it will operate the Biman Loyalty Club and provide the clubs facilities with reasonable care and skill, however, Biman Bangladesh Airlines Ltd. does not in any way warrant that the club facilities and benefits will always be available, and all terms expressed or implied by statute or otherwise on the part of Biman Bangladesh Airlines Ltd. are hereby excluded to the fullest extent permitted by law.</p>
                    <p>The failure by Biman Bangladesh Airlines Ltd. to exercise or enforce any rights herein contained shall not be deemed to be a waiver thereof nor shall it affect Biman Bangladesh Ltd.s entitlement to take any subsequent action in respect of that right or of any other right.</p>
                    <p>Should any provision of these terms and conditions be found by any court or administrative body of competent jurisdiction to be invalid or unenforceable, the invalidity or unenforceable of such provision shall not affect the other provisions of these terms and conditions. All provisions not affected by such invalidity or unenforceable shall remain in full force and effect.</p>
                    <p>These terms and conditions and the relationship between Biman Bangladesh Airlines Ltd. and each member are governed by the laws of Bangladesh. By using the Biman Loyalty Club each member submits to the non-exclusive jurisdiction of the courts of Bangladesh.</p>
                    <p>Members agree to use all the Biman Loyalty Club facilities with all reasonable care and attention and with due courtesy and respect to Biman Bangladesh Airlines Ltd.s staff and other Members.</p>
                    <p>Biman Loyalty Club Partners, and the Terms and Conditions concerning their issuance of Biman Loyalty Club miles vary by partner and are subject to change from time to time. The up-to-date list of such partnerships and offers is as featured on the Biman Loyalty Club website.</p>
                    <p>Biman Bangladesh Airlines Ltd. may change or terminate Biman Loyalty Club Partners or modify partner agreements as it deems necessary from time to time and without advance notice to members.</p>
                    <p>Your information which is held by Biman Loyalty Club includes the information that you or a Biman Loyalty Club Partner have provided to Biman Loyalty Club through your enrollment and for any future communication.</p>
                    <p>Biman Bangladesh Airlines Ltd. will honor miles only if they have been allocated and reported by a Biman Loyalty Club Partner prior to its withdrawal from Biman Loyalty Club.</p>
                </div>

                <div id="membership-responsibility" class="content-section">
                    <h4 style="margin-bottom: 20px; font-size: 30px; font-weight: bold; color: #770737;">Membership Responsibility</h4>
                    <p>Members are responsible for keeping Biman Bangladesh Airlines Ltd. up to date with their correct personal details. Biman Bangladesh Airlines Ltd. is not responsible for any loss resulting from a member's failure to notify of a change in address and email (for any notification by email).</p>
                    <p>Members will be issued with a confidential password. Members must ensure that this number is not disclosed to any unauthorized parties. Biman Bangladesh Airlines Ltd. cannot be held liable for the consequences of any unauthorized disclosure of the Password by members or unauthorized use of the password.</p>
                    <p>You must present your Biman Loyalty Club digital card to be admitted to the lounge as well as a valid boarding pass for a Biman Bangladesh Airlines Ltd. operated flight. If you fail to produce any of these items, you may not get the complimentary invitation to the lounge.</p>
                    <p>If you have recently qualified to become a Biman Loyalty Club SILVER or GOLD member, you may use a copy of the tier upgrade email sent to you to access the Lounge for the period mentioned on the letter.</p>
                    <p>It is your responsibility to be aware of both the Biman Loyalty Club miles in your account and their validity. This can be checked at any time online by accessing your Loyalty Club Member Dashboard.</p>
                    <p>You are responsible for obtaining all necessary travel documents (including but not limited to insurance and visa) for a Flight reward. It is the members responsibility to obtain all necessary Visas/Permission for his/her travel.</p>
                    <p>Member must present or display digital card when asked by concerned Sales or Check-in staff. Failing to do so may result in the refusal of getting stated benefits of Biman Loyalty Club.</p>

                </div>

                <div id="termination" class="content-section">
                    <h4 style="margin-bottom: 20px; font-size: 30px; font-weight: bold; color: #770737;">Termination</h4>
                    <p>Members may terminate their membership at any time by giving written notice or by requesting over email with legitimate documents to Biman Loyalty Club. All Biman Loyalty Club miles credited but not exchanged for Rewards, as well as any unutilized Rewards, will be cancelled as soon as you cease to be a member.</p>
                    <p>Biman Bangladesh Airlines Ltd. may forthwith terminate the membership of a member and the right of a Member to use his/her membership card and use the Biman Loyalty Club facilities, if a Member commits misconduct or fraud, misuse the Biman Loyalty Club program benefits and awards, misuse the Biman Loyalty Club, its facilities and services or fails to follow these terms and conditions. In such circumstances, Biman Bangladesh Airlines Ltd. shall simultaneously cancel all Biman Loyalty Club miles/sectors of the Member.</p>
                    <p>Biman Bangladesh Airlines Ltd. may also terminate the Biman Loyalty Club membership of a member at its complete discretion and in such circumstances will provide the member with 3 to 6-month notice of termination. Upon expiry of the notice period, all unused miles/sectors will be cancelled. Without prejudice to the foregoing, Biman Bangladesh Airlines Ltd. may alternatively at its discretion forthwith terminate or suspend a members right to use specified facilities, benefits or services of the Biman Loyalty Club, with the member retaining his/her overall membership in the Biman Loyalty Club.</p>
                    <p>Termination of membership for whatever reason shall be without prejudice to the accrued rights and remedies of Biman Bangladesh Airlines Ltd and the member as at the date of termination.</p>
                    <p>Upon the death of a member, the membership account will be closed and all outstanding Biman Loyalty Club miles/sectors will be cancelled.</p>
                    <p>The personal data supplied by members are required for the operation of the Biman Loyalty Club, delivery of associated benefits and services, ongoing research and program development and to communicate news and information to members. Failure by members to provide or keep required data up-to-date may result in Biman Bangladesh Airlines Ltd being unable to provide membership of the Biman Loyalty Club and associated benefits. In such cases, membership may be terminated.</p>
                    <p>If Biman Bangladesh Airlines Ltd. terminates or suspends Biman Loyalty Club, members will be able to redeem miles during the notice period in accordance with these Terms and Conditions, except where Biman Bangladesh Airlines Ltd is ceasing to operate an airline business and/or has gone into liquidation or other form of administration, in which case Biman Bangladesh Airlines Ltd may terminate or cancel any Awards or Benefits immediately without notice.</p>
                    <p>Biman Bangladesh Airlines Ltd. may in its absolute discretion suspend, cancel or terminate your membership or your accumulated Biman Loyalty Club miles at any time and reserves the right to seek compensation for Rewards utilized if, in Biman Bangladesh Airlines Ltd's sole judgment, that you have engaged in willful misconduct or breached any of the rules governing Biman Loyalty Club.</p>
                    <p>Biman Bangladesh Airlines Ltd gives no warranty as to the continuing availability of Biman Loyalty Club. Biman Bangladesh Airlines Ltd may terminate or suspend Biman Loyalty Club at any time. Biman Bangladesh Airlines Ltd will give at least six-month notice to members of such termination or suspension, except if Biman Bangladesh Airlines Ltd ceases to operate an airline business in which case Biman Loyalty Club will cease immediately.</p>
                </div>

                <div id="accruals" class="content-section">
                    <h4 style="margin-bottom: 20px; font-size: 30px; font-weight: bold; color: #770737;">Accruals</h4>
                    <p>Miles are based units of credits given to a Member for his/her transaction/travel with Biman Bangladesh Airlines or its partners under Biman Loyalty Club Program. Companies with whom members can earn and/or redeem miles are known as program partners and Biman Bangladesh Airlines may, at its own discretion, add or remove any company as a program partner.</p>
                    <p>To earn miles, you must quote your valid Biman Loyalty Club number (Membership number) at reservation or check-in for a qualifying flight and at the time of purchase when transacting with a Biman Loyalty Club Partner. Biman Loyalty Club miles are credited upon completion of a qualifying flight on Biman Bangladesh Airlines Ltd. or through the purchase of a qualifying product or service from one of the Biman Loyalty Club Partners.</p>
                    <p>Miles for flight activities with Biman Bangladesh Airlines Ltd. will take up to 7 working days to be credited to your account. Miles for Partner activities could take up to 6 weeks to be added to your account.</p>
                    <p>Miles are valid for a period of 2 years.</p>
                    <p>Miles can be earned for Partner activities as specified in the Partner pages on the website.</p>
                    <p>Biman Bangladesh Airlines Ltd reserves the right to make Biman Loyalty Club miles and promotional offers available to selected members based on flight activity, geographic location, program participation, or any other criteria deemed appropriate for such promotion.</p>
                    <p>Missing Miles claim must be reported online through the Biman Loyalty Club website or through e-mail request at bimanloyaltyclub@biman.gov.bd within 90 days of the date on which the transaction took place.</p>
                    <p>Neither Biman Loyalty Club miles nor the Rewards offered by the Club have any convertible cash value.</p>
                    <p>Biman Loyalty Club miles are valid for a period of two years from the date of transaction. Unused Biman Loyalty Club miles will expire at the end of the stated validity period.</p>
                    <p>Any expired Biman Loyalty Club miles will not be re-credited.</p>
                    <p>Missing Miles claim, for existing members, must be requested online through the Biman Loyalty Club website or through e-mail request at bimanloyaltyclub@biman.gov.bd within 90 days of the date on which the transaction/travel took place.</p>
                    <p>For new members, past transactions made within 90 days from the date of enrollment are valid for mileage earning. These miles can be retro-credited into members account upon request from the member at bimanloyaltyclub@biman.gov.bd within 30 days from the date of enrollment. Past transactions that are over 90 days prior to the enrollment date are not eligible for retro-credit. Biman Bangladesh Airlines Ltd may request scan copy of tickets, boarding passes, and Passport while processing a missing miles claim.</p>
                    <p>For existing members, missing miles must be claimed within 90 days from the date of actual travel, and Biman Bangladesh Airlines Ltd will not credit any missing miles after such period.</p>
                    <p>In the event you are transferred to an alternative flight due to unforeseen circumstances, you will earn Biman Loyalty Club miles as per the original flight details and not as per the revised route flown.</p>
                    <p>The following options do not qualify to earn Biman Loyalty Club miles and cannot be used to avail of Biman Loyalty Club benefits: all types of Free travel tickets, Industry and Agent discounted tickets, Chartered flights, Flight Rewards, specially discounted diplomat and government tickets, or highly discounted tickets (booked in non-revenue booking classes) by Biman Bangladesh Airlines Ltd or any other airlines.</p>
                    <p>Miles may only be earned for one frequent flyer Program for each flight or transaction unless otherwise stated in Biman Loyalty Club terms and conditions.</p>
                    <p>Biman Bangladesh Airlines Ltd code share flights operated by the code share partner carrier and marketed by Biman Bangladesh Airlines Ltd are not eligible to earn miles and will not qualify for Flight Rewards.</p>
                    <p>Biman Loyalty Club miles may be re-credited to you after deduction of applicable service charges, provided the Flight Reward is completely unused and valid.</p>
                    <p>Biman Loyalty Club miles will not be re-credited if you do not cancel your reservation at 72 hours prior to the commencement of your journey or do not report to the airport in time for your flight (no-show).</p>
                    <p>Children are eligible to Earn and Burn 75% of the listed miles.</p>
                </div>

                <div id="reward" class="content-section">
                    <h4 style="margin-bottom: 20px; font-size: 30px; font-weight: bold; color: #770737;">Reward</h4>
                    <p>All Rewards are subject to availability, certain embargoes to dates and/or to flights and/or to period. </p>
                    <p>Entitlement and use of Rewards is subject to the Terms & Conditions set by Biman Bangladesh Airlines Ltd and its Partners. </p>
                    <p>Miles are valid for two years from the date of transaction. </p>
                    <p>The number of Biman Loyalty Club miles required for a Reward is published on the Biman Loyalty Club website and is subject to change. Biman Bangladesh Airlines Ltd may withdraw, replace or substitute Rewards at any time without notice. </p>
                    <p>To claim a Reward, you must have the required number of Biman Loyalty Club miles in your account. You may redeem Biman Loyalty Club miles for specified products and services at any time provided your miles are valid. </p>
                    <p>You may request Flight Rewards, Upgrade Rewards or other Rewards on the website or at Biman Loyalty Club Service Centre in Dhaka before the Deadline period. Biman Bangladesh Airlines Ltd has the right to refuse the reward request if not asked before the Deadline. Reward tickets cannot be issued through travel agents. </p>
                    <p>Members can issue Reward Tickets against earned miles by logging into their Membership Account. Here, members can book and issue free Reward Tickets against earned miles, but members have to pay the applicable Tax(es), Government Charge(s), and Fuel/Insurance Surcharges by Credit Card online. </p>
                    <p>BLC members can also obtain redemption tickets against miles through a process at selected Biman Sales Outlets. In that case, a prior e-mail request must be sent to bimanloyaltyclub@biman.gov.bd or any prescribed web-link before the deadline period. Additional service charges either in cash or in miles will be applicable. </p>
                    <p>Redemption of Biman Loyalty Club miles may be requested only by the Biman Loyalty Club member (or by parent or legal guardian on behalf of a member less than 18 years of age). </p>
                    <p>Any taxes, fees or charges that are applicable to a Reward (Flight Reward, Upgrade Rewards or other) will have to be paid by the member at the time of making the request. </p>
                    <p>Rewards that have been bought, sold or bartered by or to you may be cancelled or confiscated instantly at the sole discretion of Biman Bangladesh Airlines Ltd and you are liable for payment of the used portions. </p>
                    <p>To the extent permitted by law, Biman Bangladesh Airlines Ltd accepts no liability whatsoever in respect of any damage, death, delay, injury or loss arising out of or in connection with the services or Rewards supplied by Biman Bangladesh Airlines Ltd or a Biman Loyalty Club Partner. </p>
                    <p>Determination of the value of the Biman Loyalty Club miles is at the sole discretion of Biman Loyalty Club. Biman Loyalty Club reserves the right to change the price of Biman Loyalty Club miles, impose additional conditions for purchasing Biman Loyalty Club miles at any time. </p>
                    <p>Flight Rewards cannot be issued as open dated tickets. </p>
                    <p>Once issued, name changes are not permitted on any Flight Reward ticket. </p>
                    <p>Flight Reward Ticket is subject to availability of seats, periodic embargoes on specific sectors and/or flights and/or flight dates. </p>
                    <p>Reward Ticket(s) issued on Redemption cannot be sold or exchanged or transferred. In the event of any misuse of Reward Ticket(s), Biman Bangladesh Airlines Ltd. reserves the right to block or withdraw such reward ticket(s). </p>
                    <p>Reward Tickets have no monetary refund value. </p>
                    <p>The entire journey must be confirmed at the time of ticketing. </p>
                    <p>A Reward Ticket, also called as Redemption Ticket, can be issued online against required miles by the member from his/her Account. For Other reward benefits members have to send an email request to Biman Loyalty Club Service Center before the mentioned deadline. The deadline depends on Members Tier Status, like Green, Silver & Gold. </p>
                    <p>If a member books a flight (Booking with Ticketing Time Limit through online by redeeming miles in that case a Reservation will be made on the time limit and such Reservation will be cancelled automatically when the time limit is over. Members must ensure to issue the Redemption Ticket before the time limit. No extension of Time Limit will be allowed. </p>
                    <p>Member must notify Biman Loyalty Club Service Center for Time Limit booking and in that case prior advice to Biman Sales Counter is required to issue such a ticket from the reservation that a member made. BLC Service Center will notify the member the place of the process center for obtaining the Reward Ticket. The notification to BLC Service Center must be made as per the deadline mentioned on the website. Biman Bangladesh Airlines Ltd has the right to refuse any such request which falls within the Deadline Period. </p>
                    <p>The change of Flight Date is permitted at any Biman Service Center with applicable charges. All Charges are mentioned in the Terms & Conditions on the Biman Loyalty Club website. </p>
                    <p>A reward ticket is valid for a maximum of 12 months from the date of issuance. </p>
                    <p>A reward ticket can be One Way or a Return Trip. </p>
                    <p>Separate RBD (booking class) i.e. R for Business Class and I for Economy Class will be used for Reward tickets. </p>
                    <p>Separate Cancel Fees and Change Fees are applicable for Reward Tickets which are not identical to those of Revenue Tickets. </p>
                    <p>A Flight Reward cannot be endorsed to another carrier in case of cancellation or delay of flight, but can be re-used to another Biman flight on a different date in case of cancellation of the flight or member can get miles credited back to his/her account upon e-mail request to Biman Loyalty Club service center, Dhaka at bimanloyaltyclub@biman.gov.bd</p>
                    <p>Re-booking of Flight Rewards (Reward Ticket) is permitted at any time on payment of applicable service charges provided that both, the miles and the ticket are valid at the time of rebooking. </p>
                    <p>Re-routing of Flight Reward/Ticket is not permitted at any time. However, a member can get a refund for the reward by crediting miles back to his/her account with applicable charges (refund fees, cancel fees, no-show etc.) and issue another reward ticket by logging into his/her membership account. </p>
                    <p>In case of a partly used Reward Ticket, the miles for the unutilized sectors of the ticket will not be credited back to the members account. </p>
                    <p>No Reward booking fees apply to Gold members. Gold members are entitled to utilize it two times during the stipulated ticketing validity period. </p>
                    <p>Regardless of tier, if the member is unable to travel voluntarily, in that case, no-show fees shall be applied according to normal ticketing and fares rules. </p>
                    <p>All above charges are non-refundable. </p>
                    <p>One-class upgrades (e.g. Economy Class to Business Class) on Biman Bangladesh Airlines Ltd flights are available, provided the revenue ticket has been issued prior to the upgrade being requested, the request is made at least 72 hours in advance of travel and if seats are available in Business Class. </p>
                    <p>Children are eligible to Earn and Burn 75% of the listed miles. </p>
                    <p>A Minor member age between 2 to below 12 years if traveling alone, is required to bring a signed copy of the Unaccompanied Minors Assistance and Handling Form during Check-In at the airport. This Form is to be completed by the minors parent or legal guardian. All other formalities of Unaccompanied Minor set by Biman Bangladesh Airlines Ltd must be accomplished by the minors parent or guardian before travel, otherwise Minor will be refused to be On-Board in the plane by check-in staff on duty. The Form is available at any Biman Sales Counter all over its network. It is the sole responsibility of the minors parent/guardian to collect and complete Form before travel. </p>
                    <p>For pregnant women, set rules of Biman Bangladesh Airlines Ltd. will be followed for travel with a redemption ticket.</p>

                </div>

                <div id="upgrade" class="content-section">
                    <h4 style="margin-bottom: 20px; font-size: 30px; font-weight: bold; color: #770737;">Upgrade</h4>
                    <p>For any redemption upgrade, a prior request is required to be sent to Biman Loyalty Club Service Center before the deadline period. For Green status, its 7 working days before departure; for Silver, 4 working days; and for Gold, 3 working days before departure of the flight. </p>
                    <p>A Member must hold a confirmed ticket for the flight they wish to upgrade prior to requesting an Upgrade Reward. All ticketing and fares rules applicable to the base ticket must be followed at all times. </p>
                    <p>To book a Business Class upgrade, you must hold a confirmed Revenue Economy Class ticket other than a ticket branded or restricted under the Biman Bangladesh Airlines Ltd. Specific Fare or Fare Family (if any). The redemption rate for a one-way upgrade from Economy Class to Business Class is 50% of the full one-way Business Class redemption rate. A return upgrade from Economy Class to Business Class is equivalent to the full one-way Business Class redemption rate on the route flown. The upgrade mileage table is set on the Biman Loyalty Club website, which is subject to change from time to time without any prior notice to members. </p>
                    <p>All upgrades are subject to the availability of seats in a specific redemption class (R-Class). </p>
                    <p>Member must pay the difference of applicable Tax, Surcharge due to government, and airlines for upgrading from a lower cabin class to a higher cabin class. </p>
                    <p>Redemption tickets in Economy Class cannot be upgraded to Business Class. </p>
                    <p>In the event that Biman Loyalty Club or operations of Biman Bangladesh Airlines Ltd are altered, suspended, cut back, or cancelled, Biman Loyalty Club is unable to guarantee that any affected Flight Rewards booked will be honored. Miles for such Flight Rewards booked but not honored will be reinstated to your Biman Loyalty Club account. </p>
                    <p>Miles are valid for a period of 2 years. </p>
                    <p>Children are eligible to Earn and Burn 75% of the listed miles. </p>

                </div>

                <div id="retain-tier-status" class="content-section">
                    <h4 style="margin-bottom: 20px; font-size: 30px; font-weight: bold; color: #770737;">Retain Tier Status</h4>
                    <p>Effective from 1st January 2023, a member must earn 50,000 miles or 20 (Twenty) times travel (minimum 10 international sectors) to Retain Silver status, 75,000 miles or 35 (Thirty-Five) times travel (minimum 20 international sectors) to Retain Gold status in the last 12 months prior to the expiry of the current tier validity. </p>
                    <p>If a Gold member is unable to earn required miles to retain current Gold status but able to earn 50,000 or 20 (Twenty) times travel (minimum 10 international sectors) miles, in that case, he/she will be downgraded to Silver status. </p>
                    <p>If a member of upper tier status (Silver/Gold) is unable to retain present tier status, in that case, he/she will be downgraded to the lower tier according to miles earned in the last 12 months prior to the expiry of the current tier validity. </p>

                </div>

                <div id="data-protection" class="content-section">
                    <h4 style="margin-bottom: 20px; font-size: 30px; font-weight: bold; color: #770737;">Data Protection</h4>
                    <p>All information is managed in accordance with the Biman Bangladesh Airlines Ltd Data Privacy Policy, Such Data Privacy Policy is deemed incorporated into the contract between Biman Bangladesh Airlines Ltd and a member. Information may be passed to supplier and partner organizations to facilitate communication of news and information to members. Members have the right not to receive such communication from either Biman Bangladesh Airlines Ltd or other partner organizations. </p>
                    <p>Members have the right to request to review and correct any personal data held by BIMAN BANGLADESH AIRLINES LTD. In such circumstances members can update personal information, such as mailing address, telephone number and e-mail address by log-in his/her own account and rest can be changed upon request to at bimanloyaltyclub@biman.gov.bd </p>

                </div>

                <div id="privacy" class="content-section">
                    <h4 style="margin-bottom: 20px; font-size: 30px; font-weight: bold; color: #770737;">Privacy</h4>
                    <p>Biman Loyalty Club Member Information: </p>
                    <p>Will be retained and used by Biman Loyalty Club and its subcontractors to ensure the efficient running of Biman Loyalty Club. </p>
                    <p>May be disclosed as required by law, including disclosures to the police, immigration and customs authorities. </p>
                    <p>May be used by Biman Loyalty Club and its Partners to send you communication about promotions, services, products and facilities offered by Biman Loyalty Club or its Partners. </p>
                    <p>May be used to develop new services, new partnerships; for marketing and market research purposes. </p>
                    <p>May be used for accounting and audit purposes, including fraud auditing. </p>
                    <p>May otherwise be used in a manner which you may authorize from time to time. </p>

                </div>

                <div id="definitions" class="content-section">
                    <h4 style="margin-bottom: 20px; font-size: 30px; font-weight: bold; color: #770737;">Definitions</h4>
                    <p><b>Applicant</b>  is an eligible person who has filled in and signed an Application Form or has enrolled online through the Biman Bangladesh Airlines Ltd. website or who has enrolled through any other approved source of enrollment and has agreed to the Terms and Conditions of the Program. </p>
                    <p><b>Account</b> means the account to/from which the Miles of a Member will be accrued/deducted. </p>
                    <p><b>Base Miles</b>  are defined as miles that Biman Loyalty Club members earn for travel on flights operated by Biman Bangladesh Airlines or Biman Loyalty Club partner airlines, excluding any bonus on fare class, tier or any other miles earned from promotions or offers. </p>
                    <p><b>Booking Class</b>  are the sub-classes of the class of service (Business Class and Economy Class) which are defined on the basis of fare paid and may vary according to restrictions such as advance purchase, minimum / maximum stay, rerouting / rebooking restrictions, refund charges etc. </p>
                    <p><b>Codeshare Flight</b>  means a flight that has an airline code or number of one airline on the ticket, but which is on an aircraft operated by another airline. </p>
                    <p><b>Forfeited Miles</b>  means any outstanding Miles balance available in the membership account which are withdrawn from the account by Biman Bangladesh Airlines as a result of membership cancellation. </p>
                    <p><b>Marketing Carrier</b> means an airline which sells tickets for a flight under its own code. The Marketing Carrier may be different from the Operating Carrier. </p>
                    <p><b>Member</b>  means any person who has applied for membership, registered as a member of Biman Loyalty Club, and who holds an Account in his or her name. </p>
                    <p><b>Membership Card</b> means in the case of a Green, Silver, or Gold member, either a physical or a digital membership card. </p>
                    <p><b>Membership Tier</b> is the membership level in Biman Loyalty Club (e.g. Green, Silver, or Gold). </p>
                    <p><b>Membership Number</b> means the membership number allocated in accordance enrolment with Biman Loyalty Club. </p>
                    <p><b>Miles</b> means points accrued by a Member under the Biman Loyalty Club loyalty programme based on the consumption of qualifying goods and services. </p>
                    <p><b>Partners</b>  means partners (including Airline Partners) and companies such as hotels, car rental companies, financial institutions, travel, retail or any other companies who provide Benefits to Members by reason of their Membership. </p>
                    <p><b>Qualifying flight</b>  means a flight taken on Biman Bangladesh Airlines Ltd or partner airlines between the point of origin and point of destination of the outward and/or return journey; that is eligible for earning Biman Loyalty Club miles. </p>
                    <p><b>Reward Ticket</b>  is any flight that Biman Bangladesh Airlines offers and can be purchased using miles that can be redeemed, subject to the terms and conditions stated in the Reward section of these program rules. </p>
                    <p><b>Upgrade Reward / Flight Reward</b>  is a specific flight, service or product to be provided by Biman Loyalty Club or a Biman Loyalty Club Partner to a member in exchange for Biman Loyalty Club miles. </p>
                    <p><b>Biman Bangladesh Airlines Flight(s) </b> means any flight marketed and operated by Biman Bangladesh Airlines. </p>
                    <p><b>Biman Loyalty Club account</b> means the account to which the Biman Loyalty Club and Tier miles of a member will be accrued or deducted. </p>
                    <p><b>Biman Loyalty Club</b>  is the Frequent Flyer Program of Biman Bangladesh Airlines Ltd, in which members collect miles in their membership account, which can then be redeemed for various benefits, privileges and Rewards. Biman Loyalty Club is owned and operated by Biman Bangladesh Airlines Ltd, and it is a trademark or registered trademark of its own. </p>
                    <p><b>Biman Bangladesh Airlines Sales Office</b> means each of the sales offices in home and abroad having the contact details as published by Biman Bangladesh Airlines website. </p>
                    <p><b>Biman Loyalty Club miles</b> are the reward currency issued to members for qualifying flights and or purchases made through Program Partners. Biman Loyalty Club miles can be redeemed in exchange for specific Redemption offers and has no cash value. </p>
                    <p><b>Biman Loyalty Club partner</b> is a participating provider of goods or services including Airlines, Banks, Hotels, Telecommunication providers, Leisure and Lifestyle service providers, Retailers, Car hire companies, and/or any other organization that Biman Bangladesh Airlines Ltd signs up to its Program. </p>
                    <p><b>Biman Loyalty Club service center</b> means the dedicated resource allocated to handle all queries and provide assistance to all Biman Loyalty Club members. Its e-mail address is bimanloyaltyclub@biman.gov.bd and/or any other e-mail address mentioned in the website from time to time. </p>
                    <p><b>Biman Loyalty Club website</b> means the Biman Loyalty Club page under https://www.biman-airlines.com/loyalty-club. </p>
                    <p><b>Transaction(s)</b> means any flight or partner activity. </p>

                </div>

                <div id="account-deletion" class="content-section">
                    <h4 style="margin-bottom: 20px; font-size: 30px; font-weight: bold; color: #770737;">Account Deletion</h4>
                    <p>To initiate the deletion of your Biman Loyalty Club account, kindly send an email to blccallcenter@biman.gov.bd, bimanloyaltyclub@biman.gov.bd or contact our customer support at +8802-8901600 Ext. 2524/2525.</p>
                </div>

                <div><br /></div>
            </main>
        </div>
    </div>

    <div class="footer">
        &copy; 2024 Biman Bangladesh Airlines. All rights reserved.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
