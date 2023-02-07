<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details | RestroHub</title>
    <link rel="stylesheet" href="../../styles/style.css">
    <script src="../../js/admin.js" defer></script>
</head>

<body>

    <?php
    require("./components/header.php");
    require("./components/sidebar.php");
    ?>

    <main class="admin_dashboard_body">

        <section class="dashboard_inner-head flex items-center">
            <h2>Customer Details</h2>
            <img src="../../images/ic_calender.svg" class="filter_by_date popper-btn" alt="filter">
        </section>

        <section class="modal items-center justify-center">
            <div class="modal_form-container p-20 small-modal shadow border-curve-md">

                <div class="modal_title-container flex items-center">
                    <h2 class="modal-title">Select an option</h2>
                    <button class="close-icon no_bg no_outline"><img src="../../images/ic_cross.svg" alt="close"></button>
                </div>

                <form action="#" method="post" class="date_filter_modal_form">

                    <div class="date_filter_form_options flex justify-start items-center wrap">
                        <div class="flex justify-start items-center">
                            <input type="radio" name="filter_option" id="filter_option-today" checked>
                            <label for="filter_option-today"> &nbsp; Today</label>
                        </div>
                        <div class="flex justify-start items-center">
                            <input type="radio" name="filter_option" id="filter_option-yesterday">
                            <label for="filter_option-yesterday"> &nbsp; Yesterday</label>
                        </div>
                        <div class="flex justify-start items-center">
                            <input type="radio" name="filter_option" id="filter_option-last-week">
                            <label for="filter_option-last-week"> &nbsp; Last week</label>
                        </div>
                        <div class="flex justify-start items-center">
                            <input type="radio" name="filter_option" id="filter_option-last-month">
                            <label for="filter_option-last-month"> &nbsp; Last month</label>
                        </div>
                        <div class="flex justify-start items-center">
                            <input type="radio" name="filter_option" id="filter_option-custom">
                            <label for="filter_option-custom"> &nbsp; Custom</label>
                        </div>

                    </div>

                    <!-- filter using custom date range start -->
                    <div class="flex justify-evenly date_filter_form_option-custom">
                        <div class="flex direction-col">
                            <label for="start-date">From:</label>
                            <input type="date" name="start-date" id="start-date">
                        </div>
                        <div class="flex direction-col">
                            <label for="end-date">To:</label>
                            <input type="date" name="end-date" id="end-date">
                        </div>
                    </div>
                    <!-- filter using custom date range end -->

                    <button type="submit" class="no_outline border-curve-md w-full button mt-20">Filter</button>

                </form>

            </div>
        </section>

        <div class="flex items-center">
            <!-- buttons for order management -->
            <div class="flex items-center">

                <!-- search form for order -->
                <form action="#" method="post" class="search_form border-curve-lg">
                    <div class="flex items-center">
                        <input type="search" placeholder="Search..." class="no_outline search_employee" name="search-employee" id="search-employee">
                        <button type="submit" class="no_bg no_outline"><img src="../../images/ic_search.svg" alt="search icon"></button>
                    </div>
                </form>

                <button class="button ml-35 border-curve-lg">All</button>
                <button class="button ml-35 border-curve-lg">Activate</button>
                <button class="button ml-35 border-curve-lg">Deactivate</button>
            </div>
        </div>

        <table class="mt-20">
            <tr class="shadow">
                <th>Sn</th>
                <th>image</th>       
                <th>Customer</th>
                <th>Location</th>
                <th>Item</th>
                <th>Email</th>
                <th>Date</th>
            </tr>
            <tr class="shadow">
                <td>1</td>
                <td>
                     <img src="../../images/logo.png"  class="table_food-img">
                </td>
                <td>Bibek</td>
                <td>Panauti</td>
                <td>60</td>
                <td>iampanutiman@gmail.com</td>
                <td>2077/03/20</td>
                <td class="table_action_container">
                    <!-- action menu -->
                    <button class="no_bg no_outline table_option-menu">
                        <img src="../../images//ic_options.svg" alt="options menu">
                    </button>
                    <!-- options -->
                    <div class="table_action_options shadow border-curve p-20 r_70 flex direction-col">
                        <div>
                            <a href="#">
                                <div class="flex items-center justify-start">
                                    <img src="../../images/ic_enable.svg" alt="accpet icon">
                                    <p>Activate</p>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <div class="flex items-center justify-start">
                                    <img src="../../images/ic_disable.svg" alt="reject icon">
                                    <p>Deactivate</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr class="shadow">
                <td>2</td>
                <td>
                     <img src="../../images/logo.png"  class="table_food-img">
                </td>
                <td>Bibek</td>
                <td>Panauti</td>
                <td>60</td>
                <td>iampanutiman@gmail.com</td>
                <td>2077/03/20</td>
                <td class="table_action_container">
                    <!-- action menu -->
                    <button class="no_bg no_outline table_option-menu">
                        <img src="../../images//ic_options.svg" alt="options menu">
                    </button>
                    <!-- options -->
                    <div class="table_action_options shadow border-curve p-20 r_70 flex direction-col">
                        <div>
                            <a href="#">
                                <div class="flex items-center justify-start">
                                    <img src="../../images/ic_enable.svg" alt="accpet icon">
                                    <p>Activate</p>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <div class="flex items-center justify-start">
                                    <img src="../../images/ic_disable.svg" alt="reject icon">
                                    <p>Deactivate</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
                        <tr class="shadow">
                <td>2</td>
                <td>
                     <img src="../../images/logo.png"  class="table_food-img">
                </td>
                <td>Bibek</td>
                <td>Panauti</td>
                <td>60</td>
                <td>iampanutiman@gmail.com</td>
                <td>2077/03/20</td>
                <td class="table_action_container">
                    <!-- action menu -->
                    <button class="no_bg no_outline table_option-menu">
                        <img src="../../images//ic_options.svg" alt="options menu">
                    </button>
                    <!-- options -->
                    <div class="table_action_options shadow border-curve p-20 r_70 flex direction-col">
                        <div>
                            <a href="#">
                                <div class="flex items-center justify-start">
                                    <img src="../../images/ic_enable.svg" alt="accpet icon">
                                    <p>Activate</p>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <div class="flex items-center justify-start">
                                    <img src="../../images/ic_disable.svg" alt="reject icon">
                                    <p>Deactivate</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
                        <tr class="shadow">
                <td>2</td>
                <td>
                     <img src="../../images/logo.png"  class="table_food-img">
                </td>
                <td>Bibek</td>
                <td>Panauti</td>
                <td>60</td>
                <td>iampanutiman@gmail.com</td>
                <td>2077/03/20</td>
                <td class="table_action_container">
                    <!-- action menu -->
                    <button class="no_bg no_outline table_option-menu">
                        <img src="../../images//ic_options.svg" alt="options menu">
                    </button>
                    <!-- options -->
                    <div class="table_action_options shadow border-curve p-20 r_70 flex direction-col">
                        <div>
                            <a href="#">
                                <div class="flex items-center justify-start">
                                    <img src="../../images/ic_enable.svg" alt="accpet icon">
                                    <p>Activate</p>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <div class="flex items-center justify-start">
                                    <img src="../../images/ic_disable.svg" alt="reject icon">
                                    <p>Deactivate</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
                        <tr class="shadow">
                <td>2</td>
                <td>
                     <img src="../../images/logo.png"  class="table_food-img">
                </td>
                <td>Bibek</td>
                <td>Panauti</td>
                <td>60</td>
                <td>iampanutiman@gmail.com</td>
                <td>2077/03/20</td>
                <td class="table_action_container">
                    <!-- action menu -->
                    <button class="no_bg no_outline table_option-menu">
                        <img src="../../images//ic_options.svg" alt="options menu">
                    </button>
                    <!-- options -->
                    <div class="table_action_options shadow border-curve p-20 r_70 flex direction-col">
                        <div>
                            <a href="#">
                                <div class="flex items-center justify-start">
                                    <img src="../../images/ic_enable.svg" alt="accpet icon">
                                    <p>Activate</p>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <div class="flex items-center justify-start">
                                    <img src="../../images/ic_disable.svg" alt="reject icon">
                                    <p>Deactivate</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </main>

</body>

</html>