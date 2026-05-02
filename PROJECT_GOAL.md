# Project Overview: Simple Social Connector

## 1. Core Objective

Build a minimal social web app that connects users via direct messaging and community groups. The primary goal is to demonstrate two specific algorithms: **Breadth-First Search (BFS)** for finding mutual friends and **Jaccard Collaborative Filtering** for community recommendations.

## 2. Minimal Tech Stack (Proposed)

- **Backend:** Node.js/Express or Python/FastAPI (Keep it lightweight)
- **Database:** PostgreSQL or SQLite (Relational structure is best for these algorithms)
- **Frontend:** Basic HTML/JS or a simple React/Tailwind setup

## 3. Database Schema (MVP)

### Users

- `id` (PK)
- `fullname`, `email`, `password`
- `profile_pic`, `location`, `contact`, `dob`, `gender`

### Communities

- `id` (PK)
- `name`, `description`, `category`, `location`
- `creator_id` (FK)

### Connections (The Graph)

- `friendships`: `user_id_1`, `user_id_2` (For BFS)
- `community_members`: `user_id`, `community_id` (For Jaccard)

### Messaging

- `direct_messages`: `sender_id`, `receiver_id`, `content`, `timestamp`
- `group_messages`: `community_id`, `sender_id`, `content`, `timestamp`

## 4. Algorithmic Requirements

- **BFS (Mutual Friends):** Starting from User A, traverse the `friendships` table to find users at a distance of 2 (friends of friends) who are not yet connected to User A.
- **Jaccard Filtering (Communities):**
  - Calculate similarity: (Communities in common) / (Total unique communities between two users).
  - Recommend communities that "similar" users have joined.

## 5. Scope Constraints (Time-Saving)

- No complex auth (Simple JWT or Session).
- Minimalist UI (Focus on functionality over aesthetics).
- No real-time sockets unless necessary (use simple polling or page refreshes for chat if time is tight).
- Find User/Community pages should be simple search bars with list results.
