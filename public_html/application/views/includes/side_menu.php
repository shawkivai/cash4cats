<nav id="sidebar" class="sidebar nav-collapse collapse">
            <ul id="side-nav" class="side-nav">
                <li class="active">
                    <a href="<?php echo(site_url().'/pages/view/home'); ?>"><i class="fa fa-home"></i> <span class="name">Home</span></a>
                </li>
                <li class="panel ">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#side-nav" href="#customers-collapse" ><i class="fa fa-users"></i> <span class="name">Customers</span></a>
                    <ul id="customers-collapse" class="panel-collapse collapse ">
                        <li class=""><a href="<?php echo(site_url().'/customers/view_customers') ?>">View Customers</a></li>
                        <li class=""><a href="<?php echo site_url() . '/pages/view/add_customer' ?>">Add Customer</a></li>
                    </ul>
                </li>
                <li class="panel ">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#side-nav" href="#invoices-collapse"><i class="fa fa-area-chart"></i> <span class="name">Invoices</span></a>
                    <ul id="invoices-collapse" class="panel-collapse collapse ">
                        <?php if ($this->session->userdata('user_type') != 'office') : ?>
                            <li class=""><a href="<?php echo(site_url().'/pages/view/invoice') ?>">New Invoice</a></li>
                        <?php endif; ?>
                        <li class=""><a href="<?php echo(site_url().'/pages/view/view_invoices') ?>">View Invoices</a></li>
                    </ul>
                </li>
             
                    <li class="panel ">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#side-nav" href="#forms-collapse"><i class="fa fa-pencil"></i> <span class="name">Catalogue</span></a>
                        <ul id="forms-collapse" class="panel-collapse collapse ">
                          <li><a href="<?php echo site_url() . '/Pages/view/add_cat' ?>">Add New Cat</a></li>

                            <?php if ($this->session->userdata('user_type') == 'office') : ?>
                                <?php echo '<li class=""><a href="' . site_url() . '/pages/catalogue_view/34' . '">Drafts</a></li>'; ?>
                            <?php endif; ?>

                            <?php if ($this->session->userdata('user_type') == 'admin') : ?>
                                <?php if ($categories) : ?>
                                    <?php foreach ($categories as $category) {
                                        echo '<li class=""><a href="' . site_url() . '/pages/catalogue_view/' . $category->category_id . '">';
                                        echo $category->name;
                                        echo '</a></li>';
                                    }
                                endif; ?>  

                            <?php endif; ?>

                        </ul>
                    </li>

                

                <?php if ($this->session->userdata('user_type') == 'admin') : ?>
                    <li class="panel ">
                        <a class="" data-toggle="" data-parent="" href="<?php echo site_url() . '/pages/view/calculator' ?>"><i class="fa fa-area-chart"></i> <span class="name">Calculator</span></a>
                    </li>
                    <li class="panel ">
                        <a class="" data-toggle="" data-parent="" href="<?php echo site_url() . '/pages/view/log' ?>"><i class="fa fa-book"></i> <span class="name">Log</span></a>
                    </li>
                <?php endif; ?>

                <?php if ($this->session->userdata('user_type') == 'admin') :?>
                    <li class="panel">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#side-nav" href="#tables-collapse"><i class="fa fa-user"></i> <span class="name">Users</span></a>
                        <ul id="tables-collapse" class="panel-collapse collapse ">
                            <li class=""><a href="<?php echo(site_url().'/users/view_users') ?>">View Users</a></li>
                            <li class=""><a href="<?php echo(site_url().'/pages/view/add_user') ?>">Add Users</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if ($this->session->userdata('user_type') != 'staff') : ?>
                    <li class="panel ">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#side-nav" href="#expense-collapse"><i class="fa fa-usd"></i> <span class="name">Expenses</span></a>
                        <ul id="expense-collapse" class="panel-collapse collapse ">
                            <li class=""><a href="<?php echo(site_url().'/pages/view/add_expense') ?>">Add Expense</a></li>
                            <li class=""><a href="<?php echo(site_url().'/pages/view/view_expense') ?>">View Expenses</a></li>
                        </ul>
                    </li>

                    <li class="panel ">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#side-nav" href="#contact-collapse"><i class="fa fa-user"></i> <span class="name">Contacts</span></a>
                        <ul id="contact-collapse" class="panel-collapse collapse ">
                            <li class=""><a href="<?php echo(site_url().'/pages/view/add_contact') ?>">Add Contact</a></li>
                            <li class=""><a href="<?php echo(site_url().'/pages/view/view_contacts') ?>">View Contacts</a></li>
                        </ul>
                    </li>

                    <li class="panel ">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#side-nav" href="#rollover-collapse"><i class="fa fa-usd"></i> <span class="name">Rollover $</span></a>
                        <ul id="rollover-collapse" class="panel-collapse collapse ">
                            <li class=""><a href="<?php echo(site_url().'/pages/view/add_rollover') ?>">Add Rollover</a></li>
                            <li class=""><a href="<?php echo(site_url().'/pages/view/view_rollovers') ?>">View Rollover</a></li>
                        </ul>
                    </li>

                <?php endif; ?>

                <?php if ($this->session->userdata('user_type') != 'office') : ?>
                    <li class="panel ">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#side-nav" href="#report-collapse"><i class="fa fa-list"></i> <span class="name">Reports</span></a>
                        <ul id="report-collapse" class="panel-collapse collapse ">

                                <li class=""><a href="<?php echo(site_url().'/pages/view/report_daily_user_summary/' . $this->session->userdata('username')); ?>">Daily Staff Summary</a></li>

                            <?php if ($this->session->userdata('user_type') == 'admin') : ?>
                                <li class=""><a href="<?php echo(site_url().'/pages/view/login_report_profit_loss') ?>">Profit/Loss Query</a></li>
                                <li class=""><a href="<?php echo(site_url().'/pages/view/login_report_shipment_summary') ?>">Shipment Summary</a></li>
                                <li class=""><a href="<?php echo(site_url().'/pages/view/login_report_bulk_pdf') ?>">Bulk PDF Export</a></li>
                                <li class=""><a href="<?php echo(site_url().'/pages/view/login_report_user_summary') ?>">Staff Summary</a></li>

                            <?php endif; ?>

                        </ul>
                    </li>
                <?php endif; ?>

                <li class="visible-xs">
                    <a href="login.html"><i class="fa fa-sign-out"></i> <span class="name">Sign Out</span></a>
                </li>
            </ul>
 </nav>
