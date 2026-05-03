# Project Directory Map - Social Connector

```text
C:.
|   .gitignore
|   communities.php
|   create-community.php
|   discover.php
|   edit-community.php
|   edit-profile.php
|   find-users.php
|   login.php
|   messages.php
|   profile.php
|   PROGRESS.md
|   projectDetail.md
|   PROJECT_GOAL.md
|   README.md
|   signup.php
|   view-community.php
|   view-profile.php
|
+---algorithm
|       BFS.php
|
+---class
|       class.Community.php
|       class.JaccardSimilarity.php
|       class.Message.php
|       class.Mutuals.php
|
+---config
|       auth.php
|       db.php
|
+---database
|       database.sql
|
+---func
|       func_user.php
|
+---includes
|       footer.php
|       header.php
|       showToast.php
|       sidebar.php
|
+---js
|       verify_and_user_login.js
|
+---php
|       community_process.php
|       debug.php
|       form_verify.php
|       login_process.php
|       search_user_process.php
|       send_user_connection.php
|       show_request.php
|       signup_process.php
|       suggest_community.php
|       suggest_people.php
|       update_profile_process.php
|
+---php_message
|       chat.php
|       user_list.php
|
+---Test
|       bfs.php
|       colabFilter.php
|       main.css
|       temp.txt
|       
\---uploads
    |   profile_*.jpg
    |
    \---communities
            community_*.jpg/webp
```

## Key Directories and Files
- **Root**: Main frontend PHP pages.
- **algorithm/**: Implementation of graph algorithms like BFS.
- **class/**: PHP classes for business logic (Community, Message, etc.).
- **config/**: Database and authentication configuration.
- **database/**: SQL schema files.
- **func/**: Helper functions.
- **includes/**: Reusable UI components (header, footer, sidebar).
- **js/**: Frontend JavaScript files.
- **php/**: Backend processing scripts (AJAX handlers).
- **php_message/**: Real-time messaging components.
- **uploads/**: User-uploaded profile and community images.
