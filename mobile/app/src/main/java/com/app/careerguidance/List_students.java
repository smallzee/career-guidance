package com.app.careerguidance;

public class List_students {

    private String level;
    private String id;
    private String image;
    private String matric;
    private String name;

    public List_students(String matric, String name, String level, String image, String id) {
        this.matric = matric;
        this.name = name;
        this.level = level;
        this.image = image;
        this.id = id;
    }

    public String getLevel() {
        return this.level;
    }

    public String getId() {
        return this.id;
    }

    public String getImage() {
        return this.image;
    }

    public String getMatric() {
        return this.matric;
    }

    public String getName() {
        return this.name;
    }

    public void setLevel(String dept) {
        this.level = dept;
    }

    public void setId(String id) {
        this.id = id;
    }

    public void setImage(String image) {
        this.image = image;
    }

    public void setMatric(String matric) {
        this.matric = matric;
    }

    public void setName(String name) {
        this.name = name;
    }

}
