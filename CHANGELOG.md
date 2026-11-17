# Changelog

All notable changes to this project will be documented in this file.

## 1.0.0 - 2026-11-17

First release: CCPA/CPRA vendor register for Laravel, part of the laravel-ccpa suite.

- Service providers, contractors and third parties (Cal. Civ. Code §1798.140(ag), (j) and (ai)), with business purpose, risk tier and data shared.
- The written contract: signed and expiry dates, plus a checklist of the terms each role requires. Service providers follow Regulations §7051(a). Contractors also need a certification. Third parties follow Regulations §7053. You can change the checklists in the config.
- Reviews by risk tier, termination and confirmation that the data was deleted or returned.
- `issues()` lists what each vendor still owes, and `ccpa:vendors [--issues] [--json]` reports it.

## [Unreleased]
