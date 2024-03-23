# Kubernetes Challenge

This project showcases proficiency in Kubernetes and containerization, demonstrating the ability to deploy, scale, and manage web applications efficiently in a Kubernetes environment.

## Overview

The Kubernetes Challenge is a spin-off of the Cloud Resume Challenge (CRC), focusing on Kubernetes proficiency and containerization skills. It aims to highlight the ability to deploy, scale, and manage web applications in a Kubernetes environment.

## Project Structure

- **Kubernetes/**: Contains Kubernetes manifests for deploying the application and database.
- **src/**: Source code files for the application.
- **Dockerfile**: Dockerfile for containerizing the application.

## Kubernetes Manifests

### Application Deployment

- **k8s-challenge-app.yaml**: Deployment configuration for the web application.
- **k8s-challenge-app-service.yaml**: Service configuration for exposing the application.
- **hpa.yaml**: Horizontal Pod Autoscaler configuration for autoscaling the application based on CPU utilization.

### Database Deployment

- **mariadb-deployment.yaml**: Deployment configuration for MariaDB.
- **mariadb-service.yaml**: Service configuration for exposing the MariaDB service.

### Configuration

- **db-connection-string.yaml**: ConfigMap for storing the database connection string.
- **db-init-script.yaml**: ConfigMap for initializing the database schema and data.
- **feature-toggle-config.yaml**: ConfigMap for enabling feature toggles, such as dark mode.

### Secrets

- **mariadb-root-password.yaml**: Secret for storing the root password of the MariaDB database.

## Deployment Instructions

1. Apply the Kubernetes manifests located in the `Kubernetes/` directory.
2. Build and deploy the Docker container using the provided Dockerfile.
3. Configure environment variables and secrets as specified in the deployment configurations.
4. Ensure proper connectivity between the application and database.
5. Test the application functionality and health probes.

For detailed implementation insights and deployment steps, refer to the provided Challenge guide or external resources.
## Acknowledgments

- [Forrest Brazeal](https://forrestbrazeal.com/) for initiating the Cloud Resume Challenge.
- [KodeKloud](https://kodekloud.com/) for collaboration on Kubernetes spin-off.

---

[Challenge Details](https://cloudresumechallenge.dev/docs/extensions/kubernetes-challenge/)
