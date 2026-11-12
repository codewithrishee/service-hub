{{-- resources/views/components/footer.blade.php --}}

<footer class="servicehub-footer" role="contentinfo">
    {{-- ── Main Footer ── --}}
    <div class="footer-main">
        <div class="container">
            <div class="row g-4 g-lg-5">

                
{{-- ── Brand + Description ── --}}
<div class="col-lg-4 col-md-6">
    <a class="footer-brand d-inline-flex align-items-center gap-2 mb-3 text-decoration-none"
       href="{{ url('/') }}">
        <img
            src="{{ asset('images/admin.png') }}"
            alt="ServiceHub"
            class="footer-logo"
        >
    </a>


                    <p class="footer-desc mb-4">
                        Trusted professionals for every home service. From repairs to
                        renovations — book verified experts in minutes and get the job
                        done right, the first time.
                    </p>

                    {{-- Trust badges --}}
                    <ul class="list-unstyled trust-list mb-0">
                        <li class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-patch-check-fill"></i>
                            <span>Verified &amp; background-checked pros</span>
                        </li>
                        <li class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-shield-check"></i>
                            <span>Secure payments &amp; satisfaction guarantee</span>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <i class="bi bi-clock-history"></i>
                            <span>On-time service, every time</span>
                        </li>
                    </ul>
                </div>

                {{-- ── Quick Links ── --}}
                <div class="col-lg-2 col-md-6 col-6">
                    <h2 class="footer-heading">Quick Links</h2>
                    <ul class="list-unstyled footer-links mb-0">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/services') }}">Services</a></li>
                        <li><a href="{{ url('/about') }}">About</a></li>
                        <li><a href="{{ url('/contact') }}">Contact</a></li>
                    </ul>
                </div>

                {{-- ── Customer ── --}}
                <div class="col-lg-2 col-md-6 col-6">
                    <h2 class="footer-heading">Customer</h2>
                    <ul class="list-unstyled footer-links mb-0">
                        <li><a href="{{ url('/book') }}">Book a Service</a></li>
                        <li><a href="{{ url('/my-bookings') }}">My Bookings</a></li>
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    </ul>
                </div>

                {{-- ── Contact ── --}}
                <div class="col-lg-4 col-md-6">
                    <h2 class="footer-heading">Get in Touch</h2>

                    <ul class="list-unstyled contact-list mb-4">
                        <li>
                            <span class="contact-icon" aria-hidden="true">
                                <i class="bi bi-geo-alt"></i>
                            </span>
                            <span>
                                ServiceHub HQ<br>
                                221B Maple Street, Suite 400<br>
                                Bengaluru, KA 560001
                            </span>
                        </li>
                        <li>
                            <span class="contact-icon" aria-hidden="true">
                                <i class="bi bi-telephone"></i>
                            </span>
                            <a href="tel:+911234567890">+91 12345 67890</a>
                        </li>
                        <li>
                            <span class="contact-icon" aria-hidden="true">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <a href="mailto:support@servicehub.com">support@servicehub.com</a>
                        </li>
                        <li>
                            <span class="contact-icon" aria-hidden="true">
                                <i class="bi bi-clock"></i>
                            </span>
                            <span>Mon – Sat: 8:00 AM – 8:00 PM</span>
                        </li>
                    </ul>

                    {{-- Social Icons --}}
                    <div class="social-wrap">
                        <span class="social-label">Follow us</span>
                        <ul class="list-unstyled d-flex gap-2 mb-0 social-list">
                            <li>
                                <a href="#" aria-label="ServiceHub on Facebook" title="Facebook">
                                    <i class="bi bi-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" aria-label="ServiceHub on Instagram" title="Instagram">
                                    <i class="bi bi-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" aria-label="ServiceHub on X" title="X">
                                    <i class="bi bi-twitter-x"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" aria-label="ServiceHub on LinkedIn" title="LinkedIn">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" aria-label="ServiceHub on YouTube" title="YouTube">
                                    <i class="bi bi-youtube"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ── Divider ── --}}
    <div class="footer-divider"></div>

    {{-- ── Copyright ── --}}
    <div class="footer-bottom">
        <div class="container">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-2 text-center text-md-start">
                <p class="mb-0 copyright-text">
                    &copy; {{ date('Y') }} <span class="fw-semibold">ServiceHub</span>. All rights reserved.
                </p>
                <ul class="list-unstyled d-flex flex-wrap justify-content-center gap-3 gap-md-4 mb-0 legal-links">
                    <li><a href="{{ url('/privacy') }}">Privacy Policy</a></li>
                    <li><a href="{{ url('/terms') }}">Terms of Service</a></li>
                    <li><a href="{{ url('/cookies') }}">Cookies</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

{{-- ── Scoped Styles ── --}}
@once
@push('styles')
<style>
    :root {
        --sh-primary: #4f46e5;
        --sh-primary-dark: #4338ca;
        --sh-primary-soft: #eef2ff;
        --sh-ink: #0f172a;
        --sh-muted: #64748b;
        --sh-border: #e9edf3;

        --ft-bg: #0b1220;
        --ft-bg-soft: #111a2e;
        --ft-text: #cbd5e1;
        --ft-heading: #f8fafc;
        --ft-muted: #94a3b8;
        --ft-border: rgba(148, 163, 184, .16);
        --ft-hover: #a5b4fc;
    }

    /* ── Footer shell ── */
    .servicehub-footer {
        background:
            radial-gradient(1200px 400px at 15% -10%, rgba(79, 70, 229, .18), transparent 60%),
            radial-gradient(900px 400px at 95% 0%, rgba(124, 108, 245, .12), transparent 55%),
            var(--ft-bg);
        color: var(--ft-text);
        font-size: .93rem;
        line-height: 1.65;
        position: relative;
    }

    .servicehub-footer .footer-main {
        padding: 4.5rem 0 3.25rem;
    }

    
.footer-logo {
    width: 190px;
    height: auto;
    max-height: 65px;
    object-fit: contain;
    display: block;
}


    .servicehub-footer .footer-brand:hover .brand-mark {
        transform: translateY(-2px) rotate(-4deg);
        box-shadow: 0 10px 26px rgba(79, 70, 229, .45);
    }

    .servicehub-footer .brand-text {
        font-size: 1.32rem;
        letter-spacing: -.02em;
        color: var(--ft-heading);
    }

    .servicehub-footer .brand-accent {
        color: var(--ft-hover);
    }

    .servicehub-footer .footer-desc {
        color: var(--ft-muted);
        max-width: 34ch;
        font-size: .92rem;
    }

    /* ── Trust list ── */
    .servicehub-footer .trust-list li {
        color: var(--ft-muted);
        font-size: .88rem;
    }

    .servicehub-footer .trust-list i {
        color: var(--ft-hover);
        font-size: .95rem;
        flex-shrink: 0;
    }

    /* ── Headings ── */
    .servicehub-footer .footer-heading {
        font-size: .78rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: var(--ft-heading);
        margin-bottom: 1.15rem;
        position: relative;
        padding-bottom: .65rem;
    }

    .servicehub-footer .footer-heading::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 26px;
        height: 2px;
        border-radius: 2px;
        background: linear-gradient(90deg, var(--sh-primary), #8b7cf6);
    }

    /* ── Link lists ── */
    .servicehub-footer .footer-links li + li {
        margin-top: .55rem;
    }

    .servicehub-footer .footer-links a {
        color: var(--ft-muted);
        text-decoration: none;
        position: relative;
        display: inline-block;
        padding-left: 0;
        transition: color .2s ease, padding-left .2s ease;
    }

    .servicehub-footer .footer-links a::before {
        content: "";
        position: absolute;
        left: 0;
        top: 50%;
        width: 0;
        height: 1.5px;
        border-radius: 2px;
        background: var(--ft-hover);
        transform: translateY(-50%);
        transition: width .22s ease;
    }

    .servicehub-footer .footer-links a:hover,
    .servicehub-footer .footer-links a:focus-visible {
        color: var(--ft-heading);
        padding-left: 14px;
    }

    .servicehub-footer .footer-links a:hover::before,
    .servicehub-footer .footer-links a:focus-visible::before {
        width: 9px;
    }

    /* ── Contact list ── */
    .servicehub-footer .contact-list li {
        display: flex;
        align-items: flex-start;
        gap: .75rem;
        color: var(--ft-muted);
        font-size: .9rem;
    }

    .servicehub-footer .contact-list li + li {
        margin-top: .85rem;
    }

    .servicehub-footer .contact-icon {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: rgba(79, 70, 229, .14);
        border: 1px solid rgba(129, 140, 248, .22);
        color: var(--ft-hover);
        font-size: .92rem;
        transition: background-color .22s ease, transform .22s ease, border-color .22s ease;
    }

    .servicehub-footer .contact-list li:hover .contact-icon {
        background: rgba(79, 70, 229, .24);
        border-color: rgba(129, 140, 248, .4);
        transform: translateY(-2px);
    }

    .servicehub-footer .contact-list a {
        color: var(--ft-muted);
        text-decoration: none;
        transition: color .2s ease;
    }

    .servicehub-footer .contact-list a:hover,
    .servicehub-footer .contact-list a:focus-visible {
        color: var(--ft-heading);
    }

    /* ── Social ── */
    .servicehub-footer .social-label {
        display: block;
        font-size: .78rem;
        font-weight: 600;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: var(--ft-muted);
        margin-bottom: .7rem;
    }

    .servicehub-footer .social-list a {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: rgba(148, 163, 184, .08);
        border: 1px solid var(--ft-border);
        color: var(--ft-muted);
        font-size: 1rem;
        text-decoration: none;
        transition: color .22s ease, background-color .22s ease,
                    border-color .22s ease, transform .22s ease;
    }

    .servicehub-footer .social-list a:hover,
    .servicehub-footer .social-list a:focus-visible {
        color: #fff;
        background: linear-gradient(135deg, var(--sh-primary) 0%, #6d5ef0 100%);
        border-color: transparent;
        transform: translateY(-3px);
        box-shadow: 0 8px 18px rgba(79, 70, 229, .35);
    }

    /* ── Divider ── */
    .servicehub-footer .footer-divider {
        height: 1px;
        background: linear-gradient(
            90deg,
            transparent 0%,
            var(--ft-border) 18%,
            rgba(148, 163, 184, .28) 50%,
            var(--ft-border) 82%,
            transparent 100%
        );
    }

    /* ── Copyright bar ── */
    .servicehub-footer .footer-bottom {
        padding: 1.35rem 0;
        background: rgba(0, 0, 0, .22);
    }

    .servicehub-footer .copyright-text {
        color: var(--ft-muted);
        font-size: .86rem;
    }

    .servicehub-footer .legal-links a {
        color: var(--ft-muted);
        font-size: .86rem;
        text-decoration: none;
        transition: color .2s ease;
    }

    .servicehub-footer .legal-links a:hover,
    .servicehub-footer .legal-links a:focus-visible {
        color: var(--ft-hover);
    }

    /* ── Focus visible ── */
    .servicehub-footer a:focus-visible {
        outline: 2px solid var(--ft-hover);
        outline-offset: 2px;
        border-radius: 4px;
    }

    /* ── Responsive ── */
    @media (max-width: 991.98px) {
        .servicehub-footer .footer-main {
            padding: 3.5rem 0 2.75rem;
        }
    }

    @media (max-width: 575.98px) {
        .servicehub-footer .footer-main {
            padding: 3rem 0 2.25rem;
        }

        .servicehub-footer .footer-desc {
            max-width: 100%;
        }

        .servicehub-footer .footer-heading {
            margin-bottom: .9rem;
            padding-bottom: .5rem;
        }
    }

    /* ── Reduced motion ── */
    @media (prefers-reduced-motion: reduce) {
        .servicehub-footer *,
        .servicehub-footer *::before,
        .servicehub-footer *::after {
            transition: none !important;
        }
    }
</style>
@endpush
@endonce