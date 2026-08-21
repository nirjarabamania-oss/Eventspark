<?php

function getTotalEvents($conn)
{
    $query = "SELECT COUNT(*) AS total
              FROM events
              WHERE status = 'Approved'";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        return 0;
    }

    $row = mysqli_fetch_assoc($result);

    return $row['total'];
}


function getTotalColleges($conn)
{
    $query = "SELECT COUNT(*) AS total
              FROM colleges";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        return 0;
    }

    $row = mysqli_fetch_assoc($result);

    return $row['total'];
}


function getTotalCategories($conn)
{
    $query = "SELECT COUNT(*) AS total
              FROM categories";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        return 0;
    }

    $row = mysqli_fetch_assoc($result);

    return $row['total'];
}

function getCategories($conn)
{
    $query = "SELECT category_id, category_name
              FROM categories
              ORDER BY category_name ASC";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        return [];
    }

    $categories = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }

    return $categories;
}
function getUpcomingEvents($conn)
{
    $query = "SELECT 
                e.event_id,
                e.event_title,
                e.description,
                e.venue,
                e.city,
                e.event_date,
                e.start_time,
                e.end_time,
                e.registration_deadline,
                e.registration_fee,
                e.poster,
                e.status,
                c.college_name,
                cat.category_name
              FROM events e
              INNER JOIN colleges c 
                    ON e.college_id = c.college_id
              INNER JOIN categories cat 
                    ON e.category_id = cat.category_id
              WHERE e.status = 'Open'
                AND e.event_date >= CURDATE()
              ORDER BY e.event_date ASC, e.start_time ASC
              LIMIT 6";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        return [];
    }

    $events = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $events[] = $row;
    }

    return $events;
}
function getFeaturedColleges($conn)
{
    $query = "SELECT
                college_id,
                college_name,
                university,
                city,
                state,
                logo
              FROM colleges
              WHERE status = 'Approved'
              ORDER BY college_id DESC
              LIMIT 6";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        return [];
    }

    $colleges = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $colleges[] = $row;
    }

    return $colleges;
}
