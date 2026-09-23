  <?php

include("../admin_auth.php");
include("../../config/database.php");

// Fetch all colleges
$query = "SELECT 
            college_id,
            college_name,
            university,
            established_year,
            email,
            phone,
            website,
            address,
            city,
            state,
            logo,
            banner,
            status,
            created_at
          FROM colleges
          ORDER BY college_id DESC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching colleges: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Colleges - EventSpark</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="../../assets/css/style.css">

</head>

<body>

<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Manage Colleges</h2>

        <a href="../dashboard.php" class="btn btn-dark">
            Back to Dashboard
        </a>

    </div>


    <?php if (mysqli_num_rows($result) > 0) { ?>

        <div class="table-responsive">

            <table class="table table-bordered table-striped table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>

                        <th>College Name</th>

                        <th>University</th>

                        <th>Established Year</th>

                        <th>Email</th>

                        <th>Phone</th>

                        <th>City</th>

                        <th>State</th>

                        <th>Status</th>

                        <th>Created At</th>

                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                <?php while ($college = mysqli_fetch_assoc($result)) { ?>

                    <tr>

                        <td>
                            <?php echo $college['college_id']; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($college['college_name']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($college['university'] ?? ''); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($college['established_year'] ?? ''); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($college['email']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($college['phone'] ?? ''); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($college['city'] ?? ''); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($college['state'] ?? ''); ?>
                        </td>

                        <td>

                            <?php if ($college['status'] == 'Pending') { ?>

                                <span class="badge bg-warning text-dark">
                                    Pending
                                </span>

                            <?php } elseif ($college['status'] == 'Approved') { ?>

                                <span class="badge bg-success">
                                    Approved
                                </span>

                            <?php } elseif ($college['status'] == 'Rejected') { ?>

                                <span class="badge bg-danger">
                                    Rejected
                                </span>

                            <?php } ?>

                        </td>

                        <td>
                            <?php echo htmlspecialchars($college['created_at']); ?>
                        </td>

                        <td>

                            <div class="d-flex gap-1">

                                <a
                                    href="approve.php?id=<?php echo $college['college_id']; ?>"
                                    class="btn btn-success btn-sm"
                                    onclick="return confirm('Are you sure you want to approve this college?');"
                                >
                                    Approve
                                </a>

                                <a
                                    href="reject.php?id=<?php echo $college['college_id']; ?>"
                                    class="btn btn-warning btn-sm"
                                    onclick="return confirm('Are you sure you want to reject this college?');"
                                >
                                    Reject
                                </a>

                                <a
                                    href="delete.php?id=<?php echo $college['college_id']; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to permanently delete this college?');"
                                >
                                    Delete
                                </a>

                            </div>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    <?php } else { ?>

        <div class="alert alert-info">
            No colleges registered yet.
        </div>

    <?php } ?>

</div>

</body>
</html>