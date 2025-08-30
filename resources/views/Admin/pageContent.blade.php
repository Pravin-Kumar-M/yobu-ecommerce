  <!-- top section -->
  <section class="no-padding-top no-padding-bottom">
      <div class="container-fluid">
          <div class="row">
              <!-- user -->
              <div class="col-md-3 col-sm-6">
                  <div class="statistic-block block">
                      <div class="progress-details d-flex align-items-end justify-content-between">
                          <div class="title">
                              <div class="icon"><i class="icon-user-1"></i></div><strong>Users Logged In</strong>
                          </div>
                          <div class="number dashtext-1">{{ $users }}</div>
                      </div>
                      <div class="progress progress-template">
                          @php
                          $maxUsers = 100; // You can change this threshold
                          $percentage = ($users / $maxUsers) * 100;
                          if ($percentage > 100) {
                          $percentage = 100; // prevent overflow
                          }
                          @endphp
                          <div role="progressbar"
                              style="width: {{ $percentage }}%"
                              aria-valuenow="{{ $users }}"
                              aria-valuemin="0"
                              aria-valuemax="{{ $maxUsers }}"
                              class="progress-bar progress-bar-template dashbg-1">
                          </div>
                      </div>
                  </div>
              </div>
              <!-- product -->
              <div class="col-md-3 col-sm-6">
                  <div class="statistic-block block">
                      <div class="progress-details d-flex align-items-end justify-content-between">
                          <div class="title">
                              <div class="icon"><i class="icon-contract"></i></div><strong>Total Products</strong>
                          </div>
                          <div class="number dashtext-2">{{ $products }}</div>
                      </div>
                      <div class="progress progress-template">
                          @php
                          $maxProducts = 100; // adjust max if needed
                          $productsPercentage = ($products / $maxProducts) * 100;
                          if ($productsPercentage > 100) $productsPercentage = 100;
                          @endphp
                          <div role="progressbar"
                              style="width: {{ $productsPercentage }}%"
                              aria-valuenow="{{ $products }}"
                              aria-valuemin="0"
                              aria-valuemax="{{ $maxProducts }}"
                              class="progress-bar progress-bar-template dashbg-2">
                          </div>
                      </div>
                  </div>
              </div>
              <!-- order -->
              <div class="col-md-3 col-sm-6">
                  <div class="statistic-block block">
                      <div class="progress-details d-flex align-items-end justify-content-between">
                          <div class="title">
                              <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>Total Orders</strong>
                          </div>
                          <div class="number dashtext-3">{{ $orders }}</div>
                      </div>
                      <div class="progress progress-template">
                          @php
                          $maxOrders = 100;
                          $ordersPercentage = ($orders / $maxOrders) * 100;
                          if ($ordersPercentage > 100) $ordersPercentage = 100;
                          @endphp
                          <div role="progressbar"
                              style="width: {{ $ordersPercentage }}%"
                              aria-valuenow="{{ $orders }}"
                              aria-valuemin="0"
                              aria-valuemax="{{ $maxOrders }}"
                              class="progress-bar progress-bar-template dashbg-3">
                          </div>
                      </div>
                  </div>
              </div>
              <!-- delivered -->
              <div class="col-md-3 col-sm-6">
                  <div class="statistic-block block">
                      <div class="progress-details d-flex align-items-end justify-content-between">
                          <div class="title">
                              <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>Total Delivered</strong>
                          </div>
                          <div class="number dashtext-4">{{ $delivered }}</div>
                      </div>
                      <div class="progress progress-template">
                          @php
                          $maxDelivered = 100;
                          $deliveredPercentage = ($delivered / $maxDelivered) * 100;
                          if ($deliveredPercentage > 100) $deliveredPercentage = 100;
                          @endphp
                          <div role="progressbar"
                              style="width: {{ $deliveredPercentage }}%"
                              aria-valuenow="{{ $delivered }}"
                              aria-valuemin="0"
                              aria-valuemax="{{ $maxDelivered }}"
                              class="progress-bar progress-bar-template dashbg-4">
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- top section ends -->

  <!-- reports section -->
  <div class="container mt-5">
      <h2 class="mb-5 text-center">Reports Dashboard</h2>

      <!-- Report Buttons -->
      <div class="d-flex flex-wrap justify-content-center mb-4" style="gap:15px;">
          <button class="btn btn-primary report-btn shadow-sm" data-type="weekly">Weekly</button>
          <button class="btn btn-secondary report-btn shadow-sm" data-type="monthly">Monthly</button>
          <button class="btn btn-success report-btn shadow-sm" data-type="quarterly">Quarterly</button>
          <button class="btn btn-warning report-btn text-white shadow-sm" data-type="annually">Annually</button>
      </div>

      <!-- Custom Report Form -->
      <form id="customReportForm" class="mb-5">
          <div class="row g-3 justify-content-center">
              <div class="col-auto">
                  <input type="date" name="from_date" class="form-control rounded" required>
              </div>
              <div class="col-auto">
                  <input type="date" name="to_date" class="form-control rounded" required>
              </div>
              <div class="col-auto">
                  <button type="submit" class="btn btn-light shadow-sm">Custom Report</button>
              </div>
          </div>
      </form>

      <!-- Report Result -->
      <div id="reportResult" class="card p-4 shadow-sm text-center">
          <h4 class="text-muted">Select a report to view data.</h4>
      </div>
  </div>

  <style>
      .report-btn {
          min-width: 130px;
          padding: 0.6rem 1rem;
          font-weight: 500;
          border-radius: 0.5rem;
          transition: transform 0.3s, box-shadow 0.3s, background-color 0.3s;
          cursor: pointer;
      }

      .report-btn:hover {
          transform: translateY(-5px);
          box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
      }

      #reportResult {
          min-height: 120px;
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 1rem;
          border-radius: 0.75rem;
          transition: all 0.5s ease-in-out;
      }

      #reportResult.show-result {
          animation: fadeInUp 0.5s ease forwards;
          background-color: #343a40;
          color: #fff;
      }

      @keyframes fadeInUp {
          0% {
              opacity: 0;
              transform: translateY(20px);
          }

          100% {
              opacity: 1;
              transform: translateY(0);
          }
      }

      .table td,
      .table th {
          vertical-align: middle;
      }

      .text-primary-animate {
          color: #0d6efd;
          transition: all 1s ease;
      }
  </style>

  <script>
      let currentReport = null;

      document.querySelectorAll('.report-btn').forEach(btn => {
          btn.addEventListener('click', function() {
              const type = this.dataset.type;
              if (currentReport === type) {
                  document.getElementById('reportResult').innerHTML = '<h4 class="text-muted">Select a report to view data.</h4>';
                  currentReport = null;
              } else {
                  currentReport = type;
                  fetchReport(type);
              }
          });
      });

      document.getElementById('customReportForm').addEventListener('submit', function(e) {
          e.preventDefault();
          const formData = new FormData(this);
          formData.append('type', 'custom');
          currentReport = 'custom';
          fetchReport('custom', formData);
      });

      function animateNumber(element, endValue, duration = 1000) {
          let start = 0;
          const range = endValue - start;
          const increment = Math.ceil(range / (duration / 20));
          const timer = setInterval(() => {
              start += increment;
              if (start >= endValue) start = endValue;
              element.innerText = start;
              if (start >= endValue) clearInterval(timer);
          }, 20);
      }

      function fetchReport(type, formData = null) {
          let data = formData ?? new FormData();
          if (!formData) data.append('type', type);

          fetch("{{ route('admin.fetch') }}", {
                  method: "POST",
                  headers: {
                      'X-CSRF-TOKEN': "{{ csrf_token() }}"
                  },
                  body: data
              })
              .then(res => res.json())
              .then(data => {
                  document.getElementById('reportResult').innerHTML = `
                <h4 class="text-white mb-3 text-primary report-fade">Report (${data.from} → ${data.to})</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped w-50 mx-auto text-white mb-0 report-fade">
                        <thead>
                            <tr>
                                <th class="text-center">Metric</th>
                                <th class="text-center">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b>Total Orders</b></td>
                                <td class="text-success text-center" id="ordersCount">0</td>
                            </tr>
                            <tr>
                                <td><b>Products Sold</b></td>
                                <td class="text-success text-center" id="productsSold">0</td>
                            </tr>
                            <tr>
                                <td><b>New User Registrations</b></td>
                                <td class="text-success text-center" id="userLogins">0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            `;

                  document.querySelectorAll('.report-fade').forEach(el => {
                      el.style.opacity = 0;
                      el.style.transition = 'opacity 0.5s ease-in-out';
                      setTimeout(() => el.style.opacity = 1, 50);
                  });

                  animateNumber(document.getElementById('ordersCount'), data.ordersCount, 1000);
                  animateNumber(document.getElementById('productsSold'), data.productsSold, 1000);
                  animateNumber(document.getElementById('userLogins'), data.userLogins, 1000);
              });
      }
  </script>




  <!-- charts section -->
  <section class="no-padding-bottom">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-4">
                  <div class="bar-chart block no-margin-bottom">
                      <canvas id="barChartExample1"></canvas>
                  </div>
                  <div class="bar-chart block">
                      <canvas id="barChartExample2"></canvas>
                  </div>
              </div>
              <div class="col-lg-8">
                  <div class="line-cahrt block">
                      <canvas id="lineCahrt"></canvas>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- end of charts section -->

  <!-- stats section -->
  <section class="no-padding-bottom">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-6">
                  <div class="stats-2-block block d-flex">
                      <div class="stats-2 d-flex">
                          <div class="stats-2-arrow low"><i class="fa fa-caret-down"></i></div>
                          <div class="stats-2-content"><strong class="d-block">5.657</strong><span class="d-block">Standard Scans</span>
                              <div class="progress progress-template progress-small">
                                  <div role="progressbar" style="width: 60%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template progress-bar-small dashbg-2"></div>
                              </div>
                          </div>
                      </div>
                      <div class="stats-2 d-flex">
                          <div class="stats-2-arrow height"><i class="fa fa-caret-up"></i></div>
                          <div class="stats-2-content"><strong class="d-block">3.1459</strong><span class="d-block">Team Scans</span>
                              <div class="progress progress-template progress-small">
                                  <div role="progressbar" style="width: 35%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template progress-bar-small dashbg-3"></div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="stats-3-block block d-flex">
                      <div class="stats-3"><strong class="d-block">745</strong><span class="d-block">Total requests</span>
                          <div class="progress progress-template progress-small">
                              <div role="progressbar" style="width: 35%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template progress-bar-small dashbg-1"></div>
                          </div>
                      </div>
                      <div class="stats-3 d-flex justify-content-between text-center">
                          <div class="item"><strong class="d-block strong-sm">4.124</strong><span class="d-block span-sm">Threats</span>
                              <div class="line"></div><small>+246</small>
                          </div>
                          <div class="item"><strong class="d-block strong-sm">2.147</strong><span class="d-block span-sm">Neutral</span>
                              <div class="line"></div><small>+416</small>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="drills-chart block">
                      <canvas id="lineChart1"></canvas>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- end of stats section -->

  <!-- user section -->
  <section class="no-padding-bottom">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-4">
                  <div class="user-block block text-center">
                      <div class="avatar"><img src="img/avatar-1.jpg" alt="..." class="img-fluid">
                          <div class="order dashbg-2">1st</div>
                      </div><a href="#" class="user-title">
                          <h3 class="h5">Richard Nevoreski</h3><span>@richardnevo</span>
                      </a>
                      <div class="contributions">950 Contributions</div>
                      <div class="details d-flex">
                          <div class="item"><i class="icon-info"></i><strong>150</strong></div>
                          <div class="item"><i class="fa fa-gg"></i><strong>340</strong></div>
                          <div class="item"><i class="icon-flow-branch"></i><strong>460</strong></div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="user-block block text-center">
                      <div class="avatar"><img src="img/avatar-4.jpg" alt="..." class="img-fluid">
                          <div class="order dashbg-1">2nd</div>
                      </div><a href="#" class="user-title">
                          <h3 class="h5">Samuel Watson</h3><span>@samwatson</span>
                      </a>
                      <div class="contributions">772 Contributions</div>
                      <div class="details d-flex">
                          <div class="item"><i class="icon-info"></i><strong>80</strong></div>
                          <div class="item"><i class="fa fa-gg"></i><strong>420</strong></div>
                          <div class="item"><i class="icon-flow-branch"></i><strong>272</strong></div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="user-block block text-center">
                      <div class="avatar"><img src="img/avatar-6.jpg" alt="..." class="img-fluid">
                          <div class="order dashbg-4">3rd</div>
                      </div><a href="#" class="user-title">
                          <h3 class="h5">Sebastian Wood</h3><span>@sebastian</span>
                      </a>
                      <div class="contributions">620 Contributions</div>
                      <div class="details d-flex">
                          <div class="item"><i class="icon-info"></i><strong>150</strong></div>
                          <div class="item"><i class="fa fa-gg"></i><strong>280</strong></div>
                          <div class="item"><i class="icon-flow-branch"></i><strong>190</strong></div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="public-user-block block">
              <div class="row d-flex align-items-center">
                  <div class="col-lg-4 d-flex align-items-center">
                      <div class="order">4th</div>
                      <div class="avatar"> <img src="img/avatar-1.jpg" alt="..." class="img-fluid"></div><a href="#" class="name"><strong class="d-block">Tomas Hecktor</strong><span class="d-block">@tomhecktor</span></a>
                  </div>
                  <div class="col-lg-4 text-center">
                      <div class="contributions">410 Contributions</div>
                  </div>
                  <div class="col-lg-4">
                      <div class="details d-flex">
                          <div class="item"><i class="icon-info"></i><strong>110</strong></div>
                          <div class="item"><i class="fa fa-gg"></i><strong>200</strong></div>
                          <div class="item"><i class="icon-flow-branch"></i><strong>100</strong></div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="public-user-block block">
              <div class="row d-flex align-items-center">
                  <div class="col-lg-4 d-flex align-items-center">
                      <div class="order">5th</div>
                      <div class="avatar"> <img src="img/avatar-2.jpg" alt="..." class="img-fluid"></div><a href="#" class="name"><strong class="d-block">Alexander Shelby</strong><span class="d-block">@alexshelby</span></a>
                  </div>
                  <div class="col-lg-4 text-center">
                      <div class="contributions">320 Contributions</div>
                  </div>
                  <div class="col-lg-4">
                      <div class="details d-flex">
                          <div class="item"><i class="icon-info"></i><strong>150</strong></div>
                          <div class="item"><i class="fa fa-gg"></i><strong>120</strong></div>
                          <div class="item"><i class="icon-flow-branch"></i><strong>50</strong></div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="public-user-block block">
              <div class="row d-flex align-items-center">
                  <div class="col-lg-4 d-flex align-items-center">
                      <div class="order">6th</div>
                      <div class="avatar"> <img src="img/avatar-6.jpg" alt="..." class="img-fluid"></div><a href="#" class="name"><strong class="d-block">Arther Kooper</strong><span class="d-block">@artherkooper</span></a>
                  </div>
                  <div class="col-lg-4 text-center">
                      <div class="contributions">170 Contributions</div>
                  </div>
                  <div class="col-lg-4">
                      <div class="details d-flex">
                          <div class="item"><i class="icon-info"></i><strong>60</strong></div>
                          <div class="item"><i class="fa fa-gg"></i><strong>70</strong></div>
                          <div class="item"><i class="icon-flow-branch"></i><strong>40</strong></div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- end of user section -->


  <section class="margin-bottom-sm">
      <div class="container-fluid">
          <div class="row d-flex align-items-stretch">
              <div class="col-lg-4">
                  <div class="stats-with-chart-1 block">
                      <div class="title"> <strong class="d-block">Sales Difference</strong><span class="d-block">Lorem ipsum dolor sit</span></div>
                      <div class="row d-flex align-items-end justify-content-between">
                          <div class="col-5">
                              <div class="text"><strong class="d-block dashtext-3">$740</strong><span class="d-block">May 2017</span><small class="d-block">320 Sales</small></div>
                          </div>
                          <div class="col-7">
                              <div class="bar-chart chart">
                                  <canvas id="salesBarChart1"></canvas>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="stats-with-chart-1 block">
                      <div class="title"> <strong class="d-block">Visit Statistics</strong><span class="d-block">Lorem ipsum dolor sit</span></div>
                      <div class="row d-flex align-items-end justify-content-between">
                          <div class="col-4">
                              <div class="text"><strong class="d-block dashtext-1">$457</strong><span class="d-block">May 2017</span><small class="d-block">210 Sales</small></div>
                          </div>
                          <div class="col-8">
                              <div class="bar-chart chart">
                                  <canvas id="visitPieChart"></canvas>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="stats-with-chart-1 block">
                      <div class="title"> <strong class="d-block">Sales Activities</strong><span class="d-block">Lorem ipsum dolor sit</span></div>
                      <div class="row d-flex align-items-end justify-content-between">
                          <div class="col-5">
                              <div class="text"><strong class="d-block dashtext-2">80%</strong><span class="d-block">May 2017</span><small class="d-block">+35 Sales</small></div>
                          </div>
                          <div class="col-7">
                              <div class="bar-chart chart">
                                  <canvas id="salesBarChart2"></canvas>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <section class="no-padding-bottom">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-6">
                  <div class="checklist-block block">
                      <div class="title"><strong>To Do List</strong></div>
                      <div class="checklist">
                          <div class="item d-flex align-items-center">
                              <input type="checkbox" id="input-1" name="input-1" class="checkbox-template">
                              <label for="input-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</label>
                          </div>
                          <div class="item d-flex align-items-center">
                              <input type="checkbox" id="input-2" name="input-2" checked class="checkbox-template">
                              <label for="input-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</label>
                          </div>
                          <div class="item d-flex align-items-center">
                              <input type="checkbox" id="input-3" name="input-3" class="checkbox-template">
                              <label for="input-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</label>
                          </div>
                          <div class="item d-flex align-items-center">
                              <input type="checkbox" id="input-4" name="input-4" class="checkbox-template">
                              <label for="input-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</label>
                          </div>
                          <div class="item d-flex align-items-center">
                              <input type="checkbox" id="input-5" name="input-5" class="checkbox-template">
                              <label for="input-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</label>
                          </div>
                          <div class="item d-flex align-items-center">
                              <input type="checkbox" id="input-6" name="input-6" class="checkbox-template">
                              <label for="input-6">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</label>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-6">{{asset('')}}admincss/
                  <div class="messages-block block">
                      <div class="title"><strong>New Messages</strong></div>
                      <div class="messages"><a href="#" class="message d-flex align-items-center">
                              <div class="profile"><img src="img/avatar-3.jpg" alt="..." class="img-fluid">
                                  <div class="status online"></div>
                              </div>
                              <div class="content"> <strong class="d-block">Nadia Halsey</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">9:30am</small></div>
                          </a><a href="#" class="message d-flex align-items-center">
                              <div class="profile"><img src="img/avatar-2.jpg" alt="..." class="img-fluid">
                                  <div class="status away"></div>
                              </div>
                              <div class="content"> <strong class="d-block">Peter Ramsy</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">7:40am</small></div>
                          </a><a href="#" class="message d-flex align-items-center">
                              <div class="profile"><img src="img/avatar-1.jpg" alt="..." class="img-fluid">
                                  <div class="status busy"></div>
                              </div>
                              <div class="content"> <strong class="d-block">Sam Kaheil</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">6:55am</small></div>
                          </a><a href="#" class="message d-flex align-items-center">
                              <div class="profile"><img src="img/avatar-5.jpg" alt="..." class="img-fluid">
                                  <div class="status offline"></div>
                              </div>
                              <div class="content"> <strong class="d-block">Sara Wood</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">10:30pm</small></div>
                          </a><a href="#" class="message d-flex align-items-center">
                              <div class="profile"><img src="img/avatar-1.jpg" alt="..." class="img-fluid">
                                  <div class="status online"></div>
                              </div>
                              <div class="content"> <strong class="d-block">Nader Magdy</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">9:47pm</small></div>
                          </a></div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <section>
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-4">
                  <div class="stats-with-chart-2 block">
                      <div class="title"><strong class="d-block">Credit Sales</strong><span class="d-block">Lorem ipsum dolor sit</span></div>
                      <div class="piechart chart">
                          <canvas id="pieChartHome1"></canvas>
                          <div class="text"><strong class="d-block">$2.145</strong><span class="d-block">Sales</span></div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="stats-with-chart-2 block">
                      <div class="title"><strong class="d-block">Channel Sales</strong><span class="d-block">Lorem ipsum dolor sit</span></div>
                      <div class="piechart chart">
                          <canvas id="pieChartHome2"></canvas>
                          <div class="text"><strong class="d-block">$7.784</strong><span class="d-block">Sales</span></div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="stats-with-chart-2 block">
                      <div class="title"><strong class="d-block">Direct Sales</strong><span class="d-block">Lorem ipsum dolor sit</span></div>
                      <div class="piechart chart">
                          <canvas id="pieChartHome3"></canvas>
                          <div class="text"><strong class="d-block">$4.957</strong><span class="d-block">Sales</span></div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <footer class="footer">
      <div class="footer__block block no-margin-bottom">
          <div class="container-fluid text-center">
              <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
              <!-- <p class="no-margin-bottom">2018 &copy; Your company. Download From <a target="_blank" href="https://templateshub.net">Templates Hub</a>.</p> -->
          </div>
      </div>
  </footer>