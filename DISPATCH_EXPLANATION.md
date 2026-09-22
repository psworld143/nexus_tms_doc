# DISPATCH — System Explanation

*A plain-language guide to what DISPATCH is, what it does, and how it works. Based on the official documentation in `dispatch/doc_data.php`.*

---

## 1. What is DISPATCH?

**DISPATCH is a Trucking Management System (TMS)** — a web-based platform that helps trucking companies run their entire operation from one place.

Think of it as the "operating system" for a trucking business. Instead of using spreadsheets, paper logs, and separate apps for loads, drivers, trucks, payroll, and compliance, everything lives in one connected system.

---

## 2. The Problem It Solves

Running a trucking company means juggling many things at once:

| Challenge | Without a TMS | With DISPATCH |
|-----------|---------------|---------------|
| Tracking loads | Phone calls, whiteboards, sticky notes | Live status board: Dispatched → Picked Up → Delivered |
| Government rules (FMCSA/DOT) | Manual logbooks, easy to miss deadlines | Automatic alerts for HOS limits, expiring permits, drug tests |
| Knowing where drivers are | Calling drivers one by one | Real-time driver status and ELD device data |
| Getting paid | Chasing invoices and brokers | Accounting, factoring, and payroll in one place |
| Vehicle breakdowns | Reactive repairs | Scheduled maintenance monitoring |

**The core idea:** one dashboard that shows the health of the whole business — loads, drivers, trucks, money, and legal compliance.

---

## 3. Who Uses It?

DISPATCH is designed for the key roles inside a trucking company:

- **Dispatchers** — assign loads to drivers, track deliveries, check driver hours before dispatching
- **Fleet managers** — monitor trucks, trailers, maintenance, and fleet safety scores
- **Company owners** — watch the Dashboard for overall performance (revenue, on-time rate, alerts)
- **Compliance officers** — track DOT/FMCSA rules: Hours of Service, drug testing, violations
- **Accountants** — run payroll, manage factoring companies, review fuel spending

---

## 4. How It Works — The Daily Workflow

Here is the typical lifecycle of work inside DISPATCH, from setup to payment:

### Step 1 — Setup (Account category)
The company registers (`Login & Sign Up`), then configures the system (`Settings`), uploads company `Documents`, and records `Permit & Insurance` files with expiration alerts (30/60/90-day warnings before anything expires).

### Step 2 — Build the Operation (Operations category)
The company enters its business data:
- **My Trucks** and **My Trailers** — the equipment
- **My Drivers** — the people (with **Driver Devices** for their ELD connections)
- **My Customers**, **My Shippers List**, **My Consignee Lists**, **My Brokers** — the business contacts

### Step 3 — Create and Dispatch Loads (Operations)
In **My Loads**, a dispatcher:
1. Clicks `Add Load`
2. Enters shipper, consignee, pickup/delivery addresses, dates, commodity, weight, and rate
3. Assigns a driver and truck/trailer
4. Saves — the load is now live

Before assigning, DISPATCH checks the driver's **HOS** status and warns if the driver is near a legal limit.

### Step 4 — Track to Delivery (Operations + Compliance)
The load moves through statuses: `Dispatched` → `En Route` → `Picked Up` → `Delivered`. Meanwhile, compliance runs in the background:
- **HOS** tracks each driver's duty status (On Duty / Driving / Sleeper / Off Duty), the 11-hour driving limit, the 14-hour window, the 30-minute break rule, and 34-hour restarts
- **Compliance Monitoring** and **Violations** flag problems in real time

### Step 5 — Safety Net (Safety category)
- **My Fleet** shows CSA safety scores and accident logs
- **Emergency Monitoring** sends alerts when something goes wrong on the road
- **Maintenance Monitoring** tracks vehicle health and scheduled service
- **Safety Assessments** lets managers run and review safety checks

### Step 6 — Money (Finance category)
After delivery, the financial side kicks in:
- **Accounting** records the revenue
- **My Factoring Company** handles invoice factoring (selling invoices for ~80–90% advance within 24 hours — standard industry practice)
- **My Payroll** pays the drivers
- **Fuel Reports** and **My Fuel Cards** track fuel spending
- **Loans/Cash Advance** manages company financing
- **API Integration Keys** connects DISPATCH to external software

### Step 7 — Oversight (Account + Dashboard)
- The **Dashboard** gives owners a real-time snapshot: active loads, available drivers, compliance alerts, and KPIs like on-time delivery rate and revenue trends
- **Notifications** push alerts; **Activity** logs every system event for auditing
- **Reporting** turns the data into operational insights

---

## 5. The Module Map (47 modules, 7 categories)

| Category | Modules | Purpose |
|----------|---------|---------|
| **Main** | Dashboard | The command center — real-time stats and alerts |
| **Operations** | My Loads, My Trucks, My Trailers, Driver Devices, My Drivers, My Customers, Shippers, Consignees, Brokers | The daily work — moving freight |
| **Fleet** | Truck Lease Pricing, Truck Rentals, Lease Agreements, Hire Drivers, Job Postings, External Drivers, Shout Out Scripts/Vlogs | Growing and equipping the fleet |
| **Finance** | Accounting, Payroll, Factoring, Fuel Reports, Fuel Cards, Loans, API Keys | The money side |
| **Safety** | My Fleet, Emergency Monitoring, Safety Assessments, Maintenance Monitoring, Safety Violations | Keeping drivers and trucks safe |
| **Compliance** | Compliance Monitoring, Software Options, Drug & Alcohol Testing, Violations (general/driver/vehicle), HOS | Staying legal under DOT/FMCSA rules |
| **Account** | Notifications, Activity, Maintenance, Drug & Alcohol, Documents, Permit & Insurance, Reporting, Safety, Settings, Login | Company records and system config |

---

## 6. Key Compliance Features (the hard part of trucking)

These are the features that make DISPATCH more than a spreadsheet — they encode real US federal trucking regulations:

- **11-hour driving limit** — a driver may drive at most 11 hours after 10 consecutive hours off duty
- **14-hour on-duty window** — driving must end 14 hours after the shift starts
- **30-minute break** — required after 8 hours of driving
- **34-hour restart** — resets the weekly clock (must include two 1–5 AM periods)
- **Drug & Alcohol Testing** — pre-employment, random, post-accident, and reasonable-suspicion testing per 49 CFR Part 382, with MIS reports for audits
- **Permit & Insurance tracking** — a lapsed auto liability policy can revoke a carrier's operating authority, so the system warns 30/60/90 days ahead
- **IFTA** — quarterly fuel-tax reporting by state mileage
- **ELD data** — driver devices feed Hours of Service records for DOT audits

---

## 7. What This Project (the website) Is

This repository is **DISPATCH's documentation and video-tutorial microsite** — the "help center" for the system. It contains three pages:

| Page | What it does |
|------|--------------|
| `index.php` | Video tutorial library — cards for all 47 modules, each opening a fullscreen documentation modal |
| `tutorials.php` | YouTube-style tutorial player — video grid, watch page, comments, watch history, up-next queue |
| `video_docs.php` | Documentation library — the same 47 modules presented as readable doc cards |

All content comes from one shared data file, `doc_data.php`, which defines the 47-module catalog and the full written documentation for each module. The site is intentionally simple: plain PHP + HTML + CSS + vanilla JavaScript, no database, no build step.

---

## 8. One-Sentence Summary (for the defense)

> **DISPATCH is an all-in-one trucking management system that takes a load from creation to delivery to payment — while automatically enforcing DOT safety and compliance rules — so a trucking company can replace spreadsheets, phone calls, and paper logs with a single dashboard.**
