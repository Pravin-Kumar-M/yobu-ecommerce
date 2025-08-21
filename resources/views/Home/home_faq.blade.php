<!DOCTYPE html>
<html lang="en">

<head>
    @include ('Home.home_headSection')

    <style>
        /* Keep styles isolated */
        .faq-item summary {
            font-weight: bold;
            cursor: pointer;
            padding: 25px;
            background: #f8f8f8;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .faq-item summary:hover {
            background: #f0e6ff;
        }

        .faq-list {
            list-style: decimal;
            margin-left: 20px;
            padding: 20px;
            animation: fadeIn 0.4s ease;
            font-weight: bold;
            font-size: 20px;
        }

        .faq-list li {
            margin-bottom: 12px;
        }

        .faq-list p {
            margin-top: 5px;
            line-height: 1.6;
        }

        .faq-list h4 {
            font-weight: bold;
        }

        /* Smooth fade-in animation for content */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <!-- Page Preloader -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include ('Home.home_header')

    <section class="container mb-5">
        <div class="card">
            <h2 class="text-center p-5"><b>Frequently Asked Questions</b></h2>
            <!-- 1st faq -->
            <div class="faq-item">
                <details>
                    <summary>About Customized Products</summary>

                    <ol class="faq-list">
                        <li>
                            <h4>What is a customized product?</h4>
                            <p>
                                A customized product is any item you can personalize to your liking—such as choosing colors, adding names, designs, images, or special text. Our site lets you easily create unique t-shirts, toys, jerseys, household gifts, and more, making every order personal and one-of-a-kind.
                            </p>
                        </li>
                        <li>
                            <h4>What products can I customize on your website?</h4>
                            <p>
                                You can customize a wide variety of items, including t-shirts, hoodies, toys, sports jerseys, mugs, home decor, and gifts. Each product page will show the available customization options.
                            </p>
                        </li>
                    </ol>

                </details>
            </div>

            <!-- 2nd faq -->
            <div class="faq-item">
                <details>
                    <summary>Ordering Process</summary>
                    <ol class="faq-list">
                        <li>
                            <h4> How do I customize and order a product?</h4>
                            <p>
                                Select your product, use our design tool to add your text, image, or choose from pre-made options, then add it to your cart and checkout. For help, our design tool offers step-by-step prompts for adding names, images, and other details.
                            </p>
                        </li>
                        <li>
                            <h4>Can I see a preview of my design before ordering?</h4>
                            <p>
                                Absolutely! Our online designer shows you a live preview of your product with your chosen customization before you complete your order. We recommend double-checking all text and graphics before confirming your order.
                            </p>
                        </li>
                    </ol>

                </details>
            </div>

            <!-- 3rd faq -->
            <div class="faq-item">
                <details>
                    <summary>Pricing and Payment</summary>
                    <ol class="faq-list">
                        <li>
                            <h4>How much does a customized product cost?</h4>
                            <p>
                                Prices vary based on your chosen product, customization type (like print or embroidery), and quantity. You will see the final price on the product page as you add options. Bulk discounts are available for larger orders.
                            </p>
                        </li>
                        <li>
                            <h4> What payment methods do you accept?</h4>
                            <p>
                                We accept all major credit cards, PayPal, and several international payment providers. All payments are processed securely.
                            </p>
                        </li>
                    </ol>

                </details>
            </div>

            <!-- 4th faq -->
            <div class="faq-item">
                <details>
                    <summary>Shipping & Delivery</summary>
                    <ol class="faq-list">
                        <li>
                            <h4>Do you ship worldwide?</h4>
                            <p>
                                Yes, we offer global shipping to most countries. Shipping options and estimated times are shown at checkout based on your location.
                            </p>
                        </li>
                        <li>
                            <h4> How long does delivery take?</h4>
                            <p>
                                Production time for custom products usually ranges from 2–7 business days, depending on the item. Shipping times vary by region, with total delivery ranging from 5–20 business days. Expedited shipping is available in many locations.
                            </p>
                        </li>
                        <li>
                            <h4> How do I track my order?</h4>
                            <p>
                                Once your product ships, you’ll receive a tracking link via email to keep an eye on your delivery.
                            </p>
                        </li>
                    </ol>

                </details>
            </div>

            <!-- 5th faq -->
            <div class="faq-item">
                <details>
                    <summary>Design Questions</summary>
                    <ol class="faq-list">
                        <li>
                            <h4>What file types can I upload for my design?</h4>
                            <p>
                                The designer accepts most standard image formats such as JPEG, PNG, and SVG. For best quality, upload high-resolution files. If you need assistance, our support team can help ensure your images look great on the final product.
                            </p>
                        </li>
                        <li>
                            <h4>I’m not a designer. Can you help me create a design?</h4>
                            <p>
                                Our platform provides easy-to-use templates, built-in clipart, fonts, and backgrounds, so you don’t need professional skills. If you need something unique, reach out—our design team can assist or recommend resources.
                            </p>
                        </li>
                    </ol>

                </details>
            </div>

            <!-- 6th faq -->
            <div class="faq-item">
                <details>
                    <summary>Returns & Cancellations</summary>
                    <ol class="faq-list">
                        <li>
                            <h4>Can I return or exchange a customized product?</h4>
                            <p>
                                Because every custom product is made specifically for you, returns or exchanges are only available if there is a manufacturing defect or we sent the wrong item. Please contact support within 7 days of receipt with photos and details.
                            </p>
                        </li>
                        <li>
                            <h4>Can I cancel or change my order after placing it?</h4>
                            <p>
                                Our team works quickly to produce custom items, so changes or cancellations are not always possible once an order is processed. Please contact us immediately if you need to modify or cancel an order.
                            </p>
                        </li>
                    </ol>

                </details>
            </div>

            <!-- 7th faq -->
            <div class="faq-item">
                <details>
                    <summary>Bulk, Corporate & Special Orders</summary>
                    <ol class="faq-list">
                        <li>
                            <h4>Do you offer discounts for bulk orders?</h4>
                            <p>
                                Yes! We offer tiered discounts for bulk purchases—perfect for team gear, event merchandise, or corporate gifts. Contact our sales team for a custom quote on large orders.
                            </p>
                        </li>
                        <li>
                            <h4>Can I get a sample before placing a large order?</h4>
                            <p>
                                Of course. You can order a sample of your customized product before committing to a bulk or corporate purchase.
                            </p>
                        </li>
                        <li>
                            <h4> Do you work with businesses or organizations?</h4>
                            <p>
                                Yes! We partner with companies, teams, and organizations worldwide to create branded merchandise, uniforms, and promotional goods.
                            </p>
                        </li>
                    </ol>

                </details>
            </div>

            <!-- 8th faq -->
            <div class="faq-item">
                <details>
                    <summary>Other Questions</summary>
                    <ol class="faq-list">
                        <li>
                            <h4>Are my designs safe and private?</h4>
                            <p>
                                Yes, your custom designs are used strictly for producing your order and are not shared or resold.
                            </p>
                        </li>
                        <li>
                            <h4>Who owns the copyright to my custom designs?</h4>
                            <p>
                                You retain all rights to designs you create and upload, provided you have the rights to the images or text used. By uploading, you confirm you own or have permission for all artwork provided.
                            </p>
                        </li>
                        <li>
                            <h4> What should I do if I have a problem with my order?</h4>
                            <p>
                                Please reach out to our customer support team as soon as possible. We are committed to making every experience perfect and will help resolve any issues quickly.
                            </p>
                        </li>
                    </ol>

                </details>
            </div>

        </div>
    </section>

    @include ('Home.home_footer')
</body>

</html>